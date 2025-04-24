const form = document.getElementById("messageArea");

form.addEventListener('submit', function(event) {
    event.preventDefault();

    const date = new Date();
    const hour = date.getHours().toString().padStart(2, '0'); // Ensure 2 digits
    const minute = date.getMinutes().toString().padStart(2, '0'); // Ensure 2 digits
    const str_time = `${hour}:${minute}`;

    const userQuestion = document.getElementById('text');
    let question = userQuestion.value.trim(); // Trim whitespace

    if (!question) return; // Prevent empty submissions

    const messageFormeight = document.getElementById("messageFormeight");

    const userHtml = document.createElement('div');
    userHtml.innerHTML = 
        '<div class="d-flex justify-content-end mb-4"><div class="msg_cotainer_send">' +
        question +
        '<span class="msg_time_send">' +
        str_time +
        '</span></div><div class="img_cont_msg"><img src="user.png" class="rounded-circle user_img_msg" alt="User Avatar"></div></div>';

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
            'Authorization': 'Bearer csk-6pndjhhtvyv4ek88xm3rtfptpcw9m5nmw89twdk9tctwvpn4'
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
            "model": "llama3.1-8b",
            "stream": true,
            "temperature": 0.2,
            "top_p": 0.1,
        })
    };

    fetch('https://api.cerebras.ai/v1/chat/completions', options)
    .then(response => {
        if (!response.ok || !response.body) {
            throw new Error('API failed: ' + response.status + ' ' + response.statusText);
        }
        return response.body;
    })
    .then(res => readStream(res, str_time))
    .catch(err => console.error('Chatbot Error:', err));
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
                            console.error("Error parsing chunk:", e);
                        }
                    }
                });
            }
        });
    }

    message = formatTextWithBold(message);

    botHtml.innerHTML = 
        '<div class="d-flex justify-content-start mb-4"><div class="img_cont_msg"><img src="logo.png" class="rounded-circle user_img_msg" alt="Bot Avatar"></div><div class="msg_cotainer">' +
        message +
        '<span class="msg_time">' +
        str_time +
        '</span></div></div>';

    document.getElementById("messageFormeight").appendChild(botHtml);
    scrollToBottom();
}

function formatTextWithBold(text) {
    const boldRegex = /\*\*(.*?)\*\*/g;
    return text.replace(boldRegex, '<b>$1</b>');
}

function scrollToBottom() {
    const messageBody = document.getElementById("messageFormeight");
    messageBody.scrollTop = messageBody.scrollHeight;
}
//Activate MS Dev Program, please Microsoft, please renew the subcription, why not Microsoft:aaaa//
