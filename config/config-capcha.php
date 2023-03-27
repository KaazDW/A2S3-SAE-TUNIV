<?php
$SECRET_KEY = '0x4AAAAAAADR2xz5lPYphZCyMeSrpixEzk8';


$formData = array(
	'secret' => $SECRET_KEY,
	'response' => $_POST['cf-turnstile-response'],
);

$url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
$options = array(
	'http' => array(
		'header' => "Content-type: application/x-www-form-urlencoded\r\n",
		'method' => 'POST',
		'content' => http_build_query($formData),
	),
);

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$outcome = json_decode($result, true);

var_dump($outcome);

if ($outcome['success']) {
	echo "OK";
} else {
    echo "KO";
}
?>

<script>
/*
let login = <?php echo json_encode($_POST['login']); ?>
let pswd = <?php echo json_encode($_POST['password']); ?>

const SECRET_KEY = '0x4AAAAAAADR2xz5lPYphZCyMeSrpixEzk8';

async function handlePost(request) {
	const body = await request.formData();
	// Turnstile injects a token in "cf-turnstile-response".
	const token = body.get('cf-turnstile-response');
	const ip = request.headers.get('CF-Connecting-IP');

	// Validate the token by calling the
	// "/siteverify" API endpoint.
	let formData = new FormData();
	formData.append('secret', SECRET_KEY);
	formData.append('response', token);
	formData.append('remoteip', ip);

	const url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
	const result = await fetch(url, {
		body: formData,
		method: 'POST',
	});

	const outcome = await result.json();
	if (outcome.success) {
        document.body.innerHTML = 'VICTIOPE !'
        let response = connect()
        response.then(() => {
            document.location.href="";
        })
	}
}

async function connect() {
    try {
        const response = await fetch('capcha', {
            method: 'POST',
            body: {
                login: login,
                password: apswd
            }
        })
        if (!response.ok)
            throw new Error('Fail during fetching')
        return await response
    } catch (error) {
        console.error(error)
    }
}
*/
</script>




