<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message-boxApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { background-color: #f8f9fa; }
        .chat-container {
            max-width: 600px;
            margin: auto;
        }
        .chat-box {
            height: 60vh;
            overflow-y: auto;
            padding: 15px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column-reverse;
        }
        .message-box {
            background: #e9ecef;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container py-4">
    <div class="chat-container">
        <h3 class="text-center text-primary mb-3">Message-boxApp</h3>

        <!-- Messages Display -->
        <div id="messages" class="chat-box"></div>

        <!-- Message Input Form -->
        <div class="card shadow-sm mt-3">
            <div class="card-body">
                <form id="chat-form">
                    <div class="mb-2">
                        <input type="text" id="subject" class="form-control" placeholder="Subject" required>
                    </div>
                    <div class="mb-2">
                        <textarea id="details" class="form-control" rows="3" placeholder="Type a message..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    function loadMessages() {
        $.ajax({
            url: "https://givethanksgrocers.com/msg/messages.php",
            method: "GET",
            success: function (data) {
                $("#messages").html(data);
            }
        });
    }

    // Load messages every 2 seconds
    setInterval(loadMessages, 2000);
    loadMessages(); // Load initially

    // Send message without reloading
    $("#chat-form").submit(function (e) {
        e.preventDefault();
        let subject = $("#subject").val();
        let details = $("#details").val();

        $.post("messages.php", { subject: subject, details: details }, function () {
            $("#subject").val("");
            $("#details").val("");
            loadMessages();
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
