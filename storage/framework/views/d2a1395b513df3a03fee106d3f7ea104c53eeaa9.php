<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e($room); ?> Chat Room
        </h2>
     <?php $__env->endSlot(); ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
      <title>Chat Room - <?php echo e($room); ?></title>
      <style>
        .chat-box {
          width: 80%;
          height: 400px;
          border: 1px solid #000;
          overflow-y: scroll;
          margin-bottom: 10px;
          padding: 10px;
          background-color: #f1f1f1;
        }
    
        .message {
          margin-bottom: 10px;
          padding: 5px;
          border-bottom: 1px solid #ddd;
        }
    
        .username {
          font-weight: bold;
        }
      </style>
    </head>
    <body>
      <div id="chat-box" class="chat-box"></div>
      <input
        type="text"
        id="message-box"
        placeholder="Type your message here..."
        style="width: 80%; padding: 10px;"
      />
      <button onclick="sendMessage()" style="padding: 10px;">Send</button>
    
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
      <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
      <script src="<?php echo e(mix('js/app.js')); ?>"></script>
      <script>
        const room = '<?php echo e($room); ?>'; // Use the dynamic room ID passed from Blade
        
        const chatBox = document.getElementById('chat-box');
        const messageBox = document.getElementById('message-box');
    
        // Fetch messages on page load
        window.onload = fetchMessages;
    
        function fetchMessages() {
          axios.get('/messages/' + room)
            .then(response => {
              const messages = response.data;
              console.log('Fetched messages:', messages); // Debugging line
              messages.forEach(message => {
                appendMessage(message);
              });
            })
            .catch(error => {
              console.error('Error fetching messages:', error);
            });
        }
    
        function sendMessage() {
          const message = messageBox.value.trim();
          if (message === '') return;
    
          axios.post('/messages/' + room, {
            message: message,
            _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          })
          .then(response => {
            console.log('Message sent:', response.data); // Debugging line
            messageBox.value = '';
            location.reload();
            // No need to reload the page here, only append the message
          })
          .catch(error => {
            console.error('Error sending message:', error);
          });
        }
    
        function appendMessage(message) {
          const messageDiv = document.createElement('div');
          messageDiv.className = 'message';
          messageDiv.innerHTML = `<span class="username">${message.user.name}: </span><span>${message.message}</span>`;
          chatBox.appendChild(messageDiv);
          chatBox.scrollTop = chatBox.scrollHeight;
        }
    
        Echo.channel('chat.' + room)
          .listen('MessageSent', (e) => {
            console.log('Real-time message received:', e.message); // Debugging line
            appendMessage(e.message);
          });
      </script>
    </body>
    </html>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php /**PATH C:\xampp3\htdocs\MentalHealthApp\mental_health\resources\views/chatroom.blade.php ENDPATH**/ ?>