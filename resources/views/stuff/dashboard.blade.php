<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

    <br><br><br>
    <input type="text" id="pass" placeholder="Enter text to hash">
    <input type="text" id="makeHash" readonly placeholder="Hash will appear here">
    <input type="button" value="Show Hash" onclick="showHash()">

    <script>
        function showHash() {
            var text = document.getElementById('pass').value;
            $.ajax({
                url: '{{ route('generateHash') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    text: text
                },
                success: function(response) {
                    document.getElementById('makeHash').value = response.hash;
                },
                error: function(error) {
                    console.error('Error generating hash:', error);
                }
            });
        }
    </script>
</body>
</html>
