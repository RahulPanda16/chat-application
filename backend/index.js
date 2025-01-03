const express = require('express');
const cors = require("cors");
const { createServer } = require('node:http');
const { Server } = require('socket.io');
const connection = require('./config/db');
require("dotenv").config();

const app = express();
const activeUsers = new Set();
const server = createServer(app);
const io = new Server(server,{
  cors:{
    origin: '*',
    methods: ['GET','POST']
  }
});

let db;
connection().then(database =>{
  db = database;
  server.listen(3000, () => {
    console.log(`server running at http://localhost:3000`);
  });
});

app.use(cors());
app.use(express.json());

app.get('/', (req, res) => {
  res.send('<h1>Hello world</h1>');
});

io.on('connection', (socket) => {
    console.log('a user connected');
    socket.on('disconnect',()=>{
      activeUsers.delete(socket.userId);
      io.emit('chat_message',socket.userId);
      console.log('User Disconnect');
    })

    socket.on('chat_message', async (msg) =>{
      console.log('message: '+ msg);
      // console.log(socket.userId);
      socket.userId = msg;
      // console.log(socket.userId);
      activeUsers.add(msg);

      io.emit('chat_message', msg,[...activeUsers]);

      try{
        const newChat = {
          message:msg,
          timestamp:new Date().toLocaleTimeString(),
          date:new Date().toDateString()
        }
        const chatCollection = db.collection("chatDetails");
        await chatCollection.insertOne(newChat);
        console.log("Message saved to database");
      }catch(error){
        console.error("Error saving message to database");
      }
    })
})

