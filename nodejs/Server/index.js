var express = require('express'),
    app = express(),
    server = require('http').Server(app),
    io = require('socket.io')(server),
    router = express.Router(),
    routes = require("../Routes/")(router),
    helper = require("./library/helpers"),
    redis = require('redis'),
    constants = require("./config/constants");

app.use('/', router);
server.listen(constants.port, function () {
    console.log("Listening on " + constants.port + " ...");
});

/* Global: this variable is used to save all clients connected, will consist of userId and socketId */
var clients = [];

/* Global: get the socketId of the client , client is in the form staff id numbers */
var getSocketId = function (client) {
    var socketId = [];
    for (var i = 0, len = clients.length; i < len; ++i) {
        var c = clients[i];
        if (c.userId === client) {
            socketId.push(c.socketId);
        }
    }
    return socketId;
};

/*Global: send notification to all socketId of the clients specified in socketArr, socketName is the name of the notification and data is the information to be sent with the notification */
var sendNotification = function (sockectArr, sockectName, data) {
    if (sockectArr.length !== 0) {
        for (var i in sockectArr) {
            io.sockets.connected[sockectArr[i]].emit(sockectName, data);
        }
    }
};

io.on('connection', function (socket) {

    socket.on('client_info', function (data) {
        var clientInfo = new Object();
        clientInfo.userId = data.user_id;
        clientInfo.socketId = socket.id;
        clients.push(clientInfo);
        console.log('We have user connected ! total now is ' + clients.length);
        /* console.log(clients); */
    });

    var redisClient = redis.createClient();
    redisClient.subscribe('message');

    redisClient.on("message", function(channel, message) {
        /*console.log("New message in queue "+ message + "channel");*/
        message = JSON.parse(message);
        var users = message.users;
        for(var i in users) {
            sendNotification(getSocketId(users[i]), 'message', message.text);
        }
        /*socket.broadcast.emit(channel, message); */
    });

    socket.on('disconnect', function() {
        redisClient.quit();

        for (var i = 0, len = clients.length; i < len; ++i) {
            var c = clients[i];
            if (c.socketId === socket.id) {
                clients.splice(i, 1);
                break;
            }
        }
        console.log('We have user disconnected! total now is ' + clients.length);
    });

});