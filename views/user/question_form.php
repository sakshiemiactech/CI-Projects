<!DOCTYPE html>
<html>
<head>
    <title>Interactive Chat Interface</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f6f6;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .chat-container {
            width: 50%;
            height: 80vh;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
            overflow-y: auto;
        }

        .chat-message {
            margin-bottom: 10px;
            display: flex;
        }

        .user-message {
            background-color: #007bff;
            color: white;
            border-radius: 8px 8px 0 8px;
            padding: 10px;
            max-width: 80%;
        }

        .assistant-message {
            background-color: #f2f2f2;
            color: #333;
            border-radius: 8px;
            padding: 10px;
            max-width: 80%;
        }

        .input-container {
            width: 50%;
            display: flex;
            align-items: center;
            padding: 20px;
            background-color: white;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }

        #question-input {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-top: 1px solid #ccc;
            background-color: #f6f6f6;
            border-radius: 8px;
        }

        #send-icon {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #send-icon:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="chat-container" id="chat-container">
        <div class="chat-message assistant-message">
            Sure, ask away!
        </div>

        <!-- Repeat assistant messages as needed -->
    </div>

    <div class="input-container">
        <input type="text" id="question-input" placeholder="Type your question...">
        <button id="send-icon">&#x2794;</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var sendIcon = document.getElementById('send-icon');
            //var questionInput = document.getElementById('question-input').value;
            var chatContainer = document.getElementById('chat-container');
			
            sendIcon.addEventListener('click', function() {
				var questionInput = document.getElementById('question-input');
                var question = questionInput.value;
			//alert(question);
                if (question.trim() === "") return;

                // Send the question to the CodeIgniter function using fetch
                fetch('<?= base_url("get-answer") ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ question: question })
                })
                .then(response => response.json())
                .then(data => {
                    // Create user message
                    var userMessage = document.createElement('div');
                    userMessage.className = 'chat-message user-message';
                    userMessage.textContent = question;
                    chatContainer.appendChild(userMessage);

                    // Create assistant message
                    var assistantMessage = document.createElement('div');
                    assistantMessage.className = 'chat-message assistant-message';
                    assistantMessage.textContent = data.response;
                    chatContainer.appendChild(assistantMessage);

                    // Clear input
                    questionInput.value = '';

                    // Scroll to the bottom of the chat
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                })
                .catch(error => {
                    console.log('Error retrieving answer:', error);
                });
            });
        });
    </script>
</body>
</html>
