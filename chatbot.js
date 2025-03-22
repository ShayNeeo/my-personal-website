const form = document.getElementById("messageArea");

form.addEventListener('submit', function(event) {
    event.preventDefault();

    const date = new Date();
    const hour = date.getHours();
    const minute = date.getMinutes();
    const str_time = hour + ":" + minute;

    const userQuestion = document.getElementById('text');
    let question = userQuestion.value;

    const messageFormeight = document.getElementById("messageFormeight");

    const userHtml = document.createElement('div');
    userHtml.innerHTML = 
        '<div class="d-flex justify-content-end mb-4"><div class="msg_cotainer_send">' +
        question +
        '<span class="msg_time_send">' +
        str_time +
        '</span></div><div class="img_cont_msg"><img src="https://i.ibb.co/d5b84Xw/Untitled-design.png" class="rounded-circle user_img_msg"></div></div>';

    messageFormeight.appendChild(userHtml);
    scrollToBottom();

    CerebrasChatBot(question, str_time);

    userQuestion.value = "";
});

function CerebrasChatBot(question, str_time) {
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer csk-6pndjhhtvyv4ek88xm3rtfptpcw9m5nmw89twdk9tctwvpn4' // Replace with your Cerebras API key
        },
        body: JSON.stringify({
            "messages": [
                {
                    "role": "system",
                    "content": "You are a chatbot specialized in Economics and Artificial Intelligence. You are also advanced in Academic Research"
                },
                {
                    "role": "user",
                    "content": question
                }
            ],
            "model": "llama3.1-8b", // Using the model from your Cerebras example
            "stream": true,         // Assuming Cerebras supports streaming
            "temperature": 0
        })
    };

    // Replace with the actual Cerebras API endpoint (仮 endpoint based on typical REST API structure)
    fetch('https://api.cerebras.ai/v1/chat/completions', options) // Update this URL if Cerebras provides a different one
    .then(response => {
        if (!response.ok || !response.body) {
            throw new Error('API failed: ' + response.status + ' ' + response.statusText);
        }
        return response.body;
    })
    .then(res => {
        readStream(res, str_time);
    })
    .catch(err => console.log(err));
}

async function readStream(stream, str_time) {
    let message = '';
    const botHtml = document.createElement('div');
    const reader = stream.getReader();
    let done = false;

    while (!done) {
        const { value, done: isDone } = await reader.read();
        if (isDone) {
            done = true;
            break;
        }

        let str = new TextDecoder().decode(value);
        let arr = str.split("\n\n");

        arr.forEach(ele => {
            if (ele.includes("content")) {
                let data = ele.split("data: ");
                data.forEach(res => {
                    if (res.includes("content")) {
                        try {
                            res = JSON.parse(res);
                            let content = res.choices[0].delta.content.replace(/\n/g, "<br>");
                            message += content;
                        } catch (e) {
                            console.log("Error parsing chunk:", e);
                        }
                    }
                });
            }
        });
    }

    // Apply bold formatting to **text**
    message = formatTextWithBold(message);

    botHtml.innerHTML = 
        '<div class="d-flex justify-content-start mb-4"><div class="img_cont_msg"><img src="https://i.ibb.co/fSNP7Rz/icons8-chatgpt-512.png" class="rounded-circle user_img_msg"></div><div class="msg_cotainer">' +
        message +
        '<span class="msg_time">' +
        str_time +
        "</span></div></div>";

    messageFormeight.appendChild(botHtml);
    scrollToBottom();
}

function formatTextWithBold(text) {
    const boldRegex = /\*\*(.*?)\*\*/g;
    text = text.replace(boldRegex, '<b>$1</b>');
    return text;
}
function scrollToBottom() {
    var messageBody = document.getElementById("messageFormeight");
    messageBody.scrollTop = messageBody.scrollHeight;
}
