<head>
    <link rel="stylesheet" href="/assets/css/chat.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="<?php base_url("/assets/css/fontAwesome.css")?>"> -->
    <!-- <script id="message-template" type="text/x-handlebars-template">
  <li class="clearfix">
    <div class="message-data align-right">
      <span class="message-data-time" >{{time}}, Today</span> &nbsp; &nbsp;
      <span class="message-data-name" >Olia</span> <i class="fa fa-circle me"></i>
    </div>
    <div class="message other-message float-right">
      {{messageOutput}}
    </div>
  </li>
</script> -->

<!-- <script id="message-response-template" type="text/x-handlebars-template">
  <li>
    <div class="message-data">
      <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
      <span class="message-data-time">{{time}}, Today</span>
    </div>
    <div class="message my-message">
      {{response}}
    </div>
  </li>
</script> -->
</head>

<body>
<div class="container clearfix">
    <div class="people-list">
      <input type="text" name="searchUser" id="searchUser"  placeholder="Search User" class="form-control input-sm" />
      <button type="button" name="searchButton" id="searchButton" class="btn btn-primary">Search</button>

      <div id="searchResult"></div>
      
      <ul>
          <?php foreach ($users as $user) { ?>
                    <?php if ($user['firstname'] !== session('firstname')) { ?>
                      <li class="clearfix">
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01.jpg" alt="avatar" />
                        <div class="about">
                          <div class="name"  data-username="<?= $user['firstname'] ?>">
                            <?php echo $user["firstname"]?>
                          </div>
                          <div class="status">
                            <i class="fa fa-circle online"></i> online
                          </div>
                        </div>
                      </li>
                    <?php } ?>
                <?php } ?>
        
        <!-- <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_02.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Aiden Chavez</div>
            <div class="status">
              <i class="fa fa-circle offline"></i> left 7 mins ago
            </div>
          </div>
        </li>
        
        <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_03.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Mike Thomas</div>
            <div class="status">
              <i class="fa fa-circle online"></i> online
            </div>
          </div>
        </li> -->
        
        <!-- <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_04.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Erica Hughes</div>
            <div class="status">
              <i class="fa fa-circle online"></i> online
            </div>
          </div>
        </li> -->

        <!-- <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_05.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Ginger Johnston</div>
            <div class="status">
              <i class="fa fa-circle online"></i> online
            </div>
          </div>
        </li> -->
        
        <!-- <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_06.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Tracy Carpenter</div>
            <div class="status">
              <i class="fa fa-circle offline"></i> left 30 mins ago
            </div>
          </div>
        </li> -->
        
        <!-- <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_07.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Christian Kelly</div>
            <div class="status">
              <i class="fa fa-circle offline"></i> left 10 hours ago
            </div>
          </div>
        </li> -->
        
        <!-- <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_08.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Monica Ward</div>
            <div class="status">
              <i class="fa fa-circle online"></i> online
            </div>
          </div>
        </li> -->
        
        <!-- <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_09.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Dean Henry</div>
            <div class="status">
              <i class="fa fa-circle offline"></i> offline since Oct 28
            </div>
          </div>
        </li> -->
        
        <!-- <li class="clearfix">
          <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_10.jpg" alt="avatar" />
          <div class="about">
            <div class="name">Peyton Mckinney</div>
            <div class="status">
              <i class="fa fa-circle online"></i> online
            </div>
          </div>
        </li> -->
        <a href="/logout" class="logout">Logout</a>
      </ul>
    </div>
    
    <div class="chat">
      <div class="chat-header clearfix">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/chat_avatar_01.jpg" alt="avatar" />
        
        <div class="chat-about">
          <div class="chat-with"><?php echo $user["firstname"]?></div>
          <div class="chat-num-messages">Online</div>
        </div>
        <i class="fa fa-star"></i>
      </div> 
      
      <div class="chat-history">
        <ul id="messages">
          <li>
            <div class="message-data">
              <span class="message-data-name"><i class="fa fa-circle online"></i> <?php echo $user["firstname"]?></span>
              <span class="message-data-time">10:12 AM, Today</span>
            </div>
            <div class="message my-message">
              Hello
            </div>
          </li>
          
          <li class="clearfix">
            <div class="message-data align-right">
              <span class="message-data-time" >10:14 AM, Today</span> &nbsp; &nbsp;
              <span class="message-data-name" >Rahul</span> <i class="fa fa-circle me"></i>
            </div>
            <div class="message other-message" style="float:right">
              Hello
            </div>
          </li>
          
          <!-- <li>
            <div class="message-data">
              <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
              <span class="message-data-time">10:20 AM, Today</span>
            </div>
            <div class="message my-message">
              Actually everything was fine. I'm very excited to show this to our team.
            </div>
          </li> -->
          
          <!-- <li>
            <div class="message-data">
              <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
              <span class="message-data-time">10:31 AM, Today</span>
            </div>
            <i class="fa fa-circle online"></i>
            <i class="fa fa-circle online" style="color: #AED2A6"></i>
            <i class="fa fa-circle online" style="color:#DAE9DA"></i>
          </li> -->
          
        </ul>
        
      </div> <!-- end chat-history -->
      
      <div class="chat-message clearfix">
        <form action="/chat" id="form">
          <!-- <input name="" placeholder="Type your message" type="text"> -->
          <textarea style="resize:none" id="input" name="chat-message-to-send" placeholder ="Type your message" rows="2"></textarea>
          <button>Send</button>
        </form>
                
        <i class="fa fa-file-o"></i> &nbsp;&nbsp;&nbsp;
        <i class="fa fa-file-image-o"></i>
        
        <!-- <button>Send</button> -->

      </div> <!-- end chat-message -->
      
    </div> <!-- end chat -->
  </div> <!-- end container -->

  <!-- <script src="/assets/js/chat.js"></script> -->
  <script src="https://cdn.socket.io/4.8.1/socket.io.min.js"></script>
  <script>

  document.querySelectorAll(".name").forEach(user => {
      user.addEventListener('click', (e) => {
          const selectedUser = e.target.dataset.username;
          document.getElementById("form").dataset.recipientid = selectedUser;
      });
  });

  document.querySelectorAll(".name").forEach(user => {
    user.addEventListener('click', async (e) => {
        const selectedUser = e.target.dataset.username;
        const response = await fetch(`http://localhost:5001/chat-history?user=${selectedUser}`);
        const messages = await response.json();
        displayMessages(messages);
    });
});

function displayMessages(messages) {
    messages.innerHTML = ''; // Clear previous messages
    messages.forEach(msg => {
        let li = document.createElement('li');
        // Add message content and append to chat history
    });
}

  const socket = io("http://localhost:5001");
  const form = document.getElementById('form');
  const input = document.getElementById('input');
  const messages = document.getElementById('messages');
  const recipientId = '<?= session('firstname') ?>';
  console.log(recipientId);

  form.addEventListener('submit', (e) => {
      e.preventDefault();
      const recipientId = form.dataset.recipientid;
      if (!recipientId) return;
      if (input.value) {
          socket.emit('message_send', {
              recipientId,
              message: input.value
          });
          input.value = ''; 
      }
  });

  socket.on('message_received', (msg) => {
    console.log(msg);
    let li = document.createElement('li');
    let divContainer = document.createElement('div');
    let divMessage = document.createElement('div');
    let spanName = document.createElement('span');
    let spanTime = document.createElement('span');
    let onlineIcon = document.createElement('i');

    divContainer.classList.add("message-data", "align-right");
    spanName.classList.add("message-data-name");
    onlineIcon.classList.add("fa", "fa-circle", "online");
    spanTime.classList.add("message-data-time");
    divMessage.classList.add("message", "my-message");

    spanName.innerText = msg.recipientId;
    spanName.appendChild(onlineIcon);
    divContainer.appendChild(spanName);
    divContainer.appendChild(spanTime);

    divMessage.innerText = msg.message;

    li.appendChild(divContainer);
    li.appendChild(divMessage); 
    messages.appendChild(li); 
  });
</script>

</body>



