<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Logging in...</title>
</head>

<body>
    <script>
        const userData = @json($user);
        if (window.opener) {
            window.opener.postMessage({
                type: 'GOOGLE_LOGIN_SUCCESS',
                user: userData
            }, '*');
            setTimeout(() => {
                console.log('Closing popup...');
                window.close();
            }, 500);
        } else {
            window.location.href = '/';
        }
    </script>
</body>

</html>