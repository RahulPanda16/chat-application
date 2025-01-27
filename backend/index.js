const express = require("express");
const cors = require("cors");
const { createServer } = require("node:http");
const { Server } = require("socket.io");
const connection = require("./config/db");
require("dotenv").config();
// const myFirstQueue = require('./bullReceiver.js');

const app = express();
const server = createServer(app);
const io = new Server(server, {
  cors: {
    origin: "*",
    methods: ["GET", "POST"],
  },
});

let db;
connection().then((database) => {
  db = database;
  server.listen(process.env.PORT, () => {
    console.log(`server running at http://localhost:${process.env.PORT}`);
  });
});

app.use(cors());
app.use(express.json());

app.get("/", (req, res) => {
  res.send("<h1>Hello world</h1>");
});

app.get('/chat-history', async (req, res) => {
  const { user } = req.query;
  const chatCollection = db.collection("chatDetails");
  const history = await chatCollection.find({ user }).toArray();
  res.json(history);
});

io.on("connection", (socket) => {
  console.log("a user connected");

  socket.on('logged', (userName) => {
    console.log(userName + " user connected");
  });

  socket.on('joinRoom', async({sender, receiver}) => {
    const room = [sender, receiver].sort().join('-');
    console.log(`User ${sender} joined room: ${room}`);
    socket.join(room);
    try {
      const messages = await db.collection('chatDetails').find({
        $or: [
          { sender, receiver },
          { sender: receiver, receiver: sender }
        ],
      }).sort({ timestamp: 1 }).toArray();
      // console.log('Fetched messages:', messages);
      socket.emit("previousMessages", messages);
    } catch (err) {
      console.log(err);
    }
  });

  socket.on("disconnect", () => {
    io.emit("chat_message", socket.userId);
    console.log("User Disconnect");
  });

  socket.on("sendMsg", async (data) => {
    const { sender, receiver, message } = data;

    try {
      const room = [sender, receiver].sort().join('-');
      const newMessage = {
        sender,
        receiver,
        message,
        timestamp: new Date().toISOString(),
        date: new Date().toDateString(),
      };

      // myFirstQueue.add(msg);
      const chatCollection = db.collection("chatDetails");
      await chatCollection.insertOne(newMessage);

      io.to(room).emit('chat_msg', newMessage);
      console.log("Message saved to database");
    } catch (error) {
      console.error("Error saving message to database");
    }
  });
});
