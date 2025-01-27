<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free" >
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Chat Application</title>
    <meta name="description" content="" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
</head>

<body>
<link rel="stylesheet" href="<?= base_url('assets/css/chat1.css')?>" />

<div class="container mt-2 w-full h-full"> 
  <div id="chat-screen">
       <div class="sidebar">
          <div class="user-profile">
               <div class="flex items-center cursor-pointer">
                 <img class="w-[3.25rem] h-[3.25rem] rounded-full bg-cover bg-center mx-3" src="https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80" alt="User Avatar">
                 <span><?= $loginDetails['firstname']?></span>
               </div>
              <span id="chat-mode"></span>
          </div>
          <div class="relative" modelvalue="">
            <i class="absolute left-0 top-[30%] ml-3 text-center">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-5 h-5 stroke-2 text-black opacity-40 dark:text-white dark:opacity-70"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path></svg>
            </i>
            <input type="text" placeholder="Search.." class="w-[95%] m-2 h-8 py-3 px-7 border outline-none rounded-lg text-black dark:text-white dark:opacity-70 placeholder:text-black placeholder:opacity-40 dark:placeholder:text-white dark:placeholder:opacity-70 focus:outline-none focus:ring focus:ring-indigo-300 duration-200 transition ease-out text-opacity-70 border-none bg-gray-100 dark:bg-gray-700 focus:bg-white dark:focus:bg-gray-800">
              <div class="absolute top-0 right-0"><!---->
              </div>
            </div>
          <ul id="users-list">
            <?php foreach ($users as $user) { 
              if ($user['firstname'] === $loginDetails['firstname']) { continue; }         
            ?>
            <li id="agent-list" class="user w-full h-[5.75rem] px-3 py-6 mb-2 flex rounded-lg focus:bg-indigo-50 dark:active:bg-gray-600 dark:focus:bg-gray-500 dark:hover:bg-gray-600 hover:bg-indigo-100 active:bg-indigo-100 focus:outline-none transition duration-500 ease-out md:bg-indigo-50 md:dark:bg-gray-600" data-username="<?= $user['firstname']?>">
              <img  class="small-profile" src="https://cdn.pixabay.com/photo/2021/06/15/16/11/man-6339003_640.jpg" alt="User Avatar">
              <div class="user-info ">
                <span id="userheader"><?= $user['firstname']?></span>
              </div>
            </li>
            <?php } ?>
          </ul>
      </div> 
      
      <!-- Chat Area -->
      <div class="chat-area w-full">
          <div class="chat-header w-full min-h-[5.25rem] px-5 py-6">
               <div class="flex grow items-center "> 
                 <div class="w-[3.25rem] h-[3.25rem] rounded-full bg-cover bg-center mx-3" style="background-image: url(&quot;https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80&quot;);" ></div>
                 <div class="flex flex-col justify-center">
                   <span class="outline-none text-lg text-black opacity-60 dark:text-white dark:opacity-70 font-semibold leading-4 tracking-[.01rem] mb-2 default-outline cursor-pointer" id="receiverUser"><?= $loginDetails['firstname']?> </span>
                   <p class="outline-none text-sm text-black opacity-60 dark:text-white dark:opacity-70 leading-4 tracking-[.01rem] font-extralight default-outline rounded-[.25rem]" tabindex="0" aria-label="Last seen december 16, 2019"> Last seen Dec 16, 2019 </p>
                 </div>
                 <!-- src="https://media.istockphoto.com/id/1309328823/photo/headshot-portrait-of-smiling-male-employee-in-office.jpg?s=612x612&w=0&k=20&c=kPvoBm6qCYzQXMAn9JUtqLREXe9-PlZyMl9i-ibaVuY=" -->
                </div>

              <div class="flex cursor-pointer">
                <div class="group flex justify-center items-center rounded-full outline-none focus:outline-none hover:bg-gray-50 dark:hover:bg-gray-700 focus:bg-gray-50 dark:focus:bg-gray-600 transition-all duration-200 group w-7 h-7 mr-3" title="search messages" aria-label="search messages">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-[1.25rem] h-[1.25rem] text-gray-400 group-hover:text-indigo-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                  </svg>
                </div>
                <div class="relative">
                  <div class="group flex justify-center items-center rounded-full outline-none focus:outline-none hover:bg-gray-50 dark:hover:bg-gray-700 focus:bg-gray-50 dark:focus:bg-gray-600 transition-all duration-200 open-top-menu group w-7 h-7" id="open-conversation-menu" tabindex="0" aria-expanded="false" aria-controls="conversation-menu" title="toggle conversation menu" aria-label="toggle conversation menu">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="open-top-menu w-[1.25rem] h-[1.25rem] text-gray-400 group-hover:text-indigo-300">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"></path></svg>
                  </div>
                <div id="conversation-menu" aria-labelledby="open-conversation-menu"><!---->
                  <div data-v-5a116fd1="" class="right-0 absolute z-[100] w-[12.5rem] mt-2 rounded-sm bg-white dark:bg-gray-800 shadow-lg border border-gray-100 dark:border-gray-600 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1" style="display: none;"><div role="none"><button class="w-full px-4 py-3 flex items-center border-b opacity-60 dark:opacity-70 outline-none text-sm border-gray-200 dark:border-gray-600 transition-all duration-200 text-black dark:text-white active:bg-gray-100 dark:hover:bg-gray-600 dark:focus:bg-gray-600 hover:bg-gray-50" role="menuitem"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-5 w-5 mr-3 text-black opacity-60 dark:text-white dark:opacity-70"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"></path></svg> Profile Information </button><button class="w-full px-4 py-3 flex items-center border-b opacity-60 dark:opacity-70 outline-none text-sm border-gray-200 dark:border-gray-600 transition-all duration-200 text-black dark:text-white active:bg-gray-100 dark:hover:bg-gray-600 dark:focus:bg-gray-600 hover:bg-gray-50" role="menuitem"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-5 w-5 mr-3 text-black opacity-60 dark:text-white dark:opacity-70"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"></path></svg> Voice call </button><button class="w-full px-4 py-3 flex items-center border-b opacity-60 dark:opacity-70 outline-none text-sm border-gray-200 dark:border-gray-600 transition-all duration-200 text-black dark:text-white active:bg-gray-100 dark:hover:bg-gray-600 dark:focus:bg-gray-600 hover:bg-gray-50" role="menuitem"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-5 w-5 mr-3 text-black opacity-60 dark:text-white dark:opacity-70"><path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z"></path></svg> Shared media </button><button class="w-full px-4 py-3 flex items-center border-b opacity-60 dark:opacity-70 outline-none text-sm border-gray-200 dark:border-gray-600 transition-all duration-200 text-red-500 dark:hover:text-red-50 hover:bg-red-50 active:bg-red-100 dark:hover:bg-red-900" role="menuitem"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-5 w-5 mr-3"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg> Block contact </button></div></div></div></div></div>
                </div>
          <div id="messages" class="messages-container"></div>
          
          <div class="message-input h-auto min-h-[5.25rem] p-3 flex items-center">
              <div class="min-h-[2.75rem] items-center">
                <button class="group flex justify-center items-center rounded-full outline-none focus:outline-none hover:bg-gray-50 dark:hover:bg-gray-700 focus:bg-gray-50 dark:focus:bg-gray-600 transition-all duration-200 group w-8 h-8 md:mr-5 xs:mr-4" title="open select attachments modal" aria-label="open select attachments modal">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-[1.25rem] h-[1.25rem] text-gray-400 group-hover:text-indigo-300"><path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"></path></svg></button>
              </div>
                <div class="grow md:mr-5 xs:mr-4 self-end">
                  <div class="relative">
                    <input type="text" id="message-input" placeholder="Type a message..." class="emojiInput max-w-full w-full px-4 py-3 rounded-sm content-center">
                    <div class="absolute bottom-[.8125rem] right-0">
                      <button class="group flex justify-center items-center rounded-full outline-none focus:outline-none hover:bg-gray-50 dark:hover:bg-gray-700 focus:bg-gray-50 dark:focus:bg-gray-600 transition-all duration-200 toggle-picker-button group w-7 h-7 md:mr-5 xs:mr-4" title="toggle emoji picker" aria-label="toggle emoji picker">
                        <svg id="toggleButton" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-[1.50rem] h-[1.50rem] text-gray-400 group-hover:text-indigo-300 mr-3">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"></path>
                        </svg>
                      </button><div data-v-5a116fd1="" class="absolute z-10 bottom-[3.4375rem] md:right-0 xs:right-[-5rem] mt-2" style="display: none;">
                      <div role="none"></div>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="min-h-[2.75rem] flex items-center">
                  <button  class="  " title="start recording" aria-label="start recording">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-[1.25rem] h-[1.25rem] text-gray-400 group-hover:text-indigo-300">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z"></path>
                    </svg>
                  </button>
                  <button id="send-btn" class="group flex justify-center items-center outline-none rounded-full focus:outline-none transition-all duration-200 group w-7 h-7 bg-indigo-300 hover:bg-indigo-400 focus:bg-indigo-400 dark:focus:bg-indigo-300 dark:bg-indigo-400 dark:hover:bg-indigo-400 active:scale-110 mx-3" title="send message" aria-label="send message">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="w-[1.0625rem] h-[1.0625rem] text-white"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"></path></svg>
                  </button>
                </div>
              <!-- <button id="send-btn">
                    Send
            </button> -->
            <emoji-picker id="emojiPicker"></emoji-picker>
          </div>
      </div>
  </div>
</div>

    <script src="https://cdn.socket.io/4.8.1/socket.io.min.js"></script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>
    <script type="module" src="<?php base_url("/assets/js/script.js")?>"></script>
    <script>
      var socket = io.connect('http://localhost:5001');
      var chatScreen = document.getElementById('chat-screen');
      var chatMode = document.getElementById('chat-mode');
      var messageInput = document.getElementById('message-input');
      var sendBtn = document.getElementById('send-btn');
      var messagesContainer = document.getElementById('messages');
      var usersList = document.getElementById('users-list');
      var currentUser = document.getElementById('current-user');
      var chatHeader = document.getElementById('chat-header');
      var chatArea = document.getElementById('chat-area');
      var agentList = document.querySelectorAll('agent-list');

      const sender = "<?= $loginDetails['firstname'] ?>";
      let receiver = null;

      socket.emit('logged', sender);

      document.querySelectorAll('#agent-list').forEach(user => {
        user.addEventListener('click', () => {
          receiver = user.getAttribute("data-username");
          console.log('Selected receiver:', receiver);
          document.getElementById('receiverUser').innerHTML = receiver;
          messagesContainer.innerHTML = '';
          socket.emit('joinRoom', { sender, receiver });
        });
      });

      function sendMsg() {
        const message = messageInput.value.trim();
        console.log('Send button clicked:', message);
        if (message && receiver) {
          console.log('Sending message from:', sender, 'to:', receiver);
          socket.emit('sendMsg', { sender: sender, receiver: receiver, message: message });
          messageInput.value = '';
        }
      }

      socket.on('previousMessages', (messages) => {
        const chatHistory = document.getElementById('messages');
        chatHistory.innerHTML = '';
        console.log('Previous messages:', messages);
        messages.forEach(msg => {
          const date = new Date(msg.timestamp);
          const messageElement = document.createElement('div');
          messageElement.className = `message ${msg.sender === sender ? 'sent alert alert-secondary bg-indigo-50 dark:bg-gray-600' : 'received alert alert-primary'}`;
          messageElement.innerHTML = `${msg.message}<span class="time_date">${msg.date}</span></div>`;
          // ${date.getHours()}:${date.getMinutes()}   |
          chatHistory.appendChild(messageElement);
        });
        chatHistory.scrollTop = chatHistory.scrollHeight;
      });

      sendBtn.addEventListener('click', sendMsg);
      messageInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
          sendMsg();
        }
      });

      socket.on("chat_msg", (data) => {
        console.log('Received message:', data);
        const messages = document.getElementById("messages");
        const msgElement = document.createElement("div");
        msgElement.className = `message ${data.sender === sender ? 'sent alert alert-secondary bg-indigo-50 dark:bg-gray-600' : 'received alert alert-primary'}`;
        msgElement.innerHTML = `${data.message}<span class="time_date">${data.date}</span></div>`;
        msgElement.textContent = `${data.message}`;
        messages.appendChild(msgElement);
        messages.scrollTop = messages.scrollHeight;
      });

      document.querySelector('emoji-picker')
        .addEventListener('emoji-click', event => console.log(event.detail));

        const emojiPicker = document.querySelector('#emojiPicker');
        const emojiInput = document.querySelector('.emojiInput');
        const toggleButton = document.querySelector('#toggleButton');

        // Event listener for emoji click
        emojiPicker.addEventListener('emoji-click', event => {
            const emoji = event.detail.unicode;
            emojiInput.value += emoji;
        });

        // Toggle emoji picker
        toggleButton.addEventListener('click', () => {
            emojiPicker.style.display = emojiPicker.style.display === 'none' ? 'inline-block' : 'none';
            emojiPicker.style.position = emojiPicker.style.display === 'none' ? 'absolute' : 'none';
        });

        // Initialize with emoji picker hidden
        emojiPicker.style.display = 'none';
</script>

</body>
