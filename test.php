<?php
/**
 * Template Name: Test Page
 */
?>
<!DOCTYPE html>
<html>
<head>
  <title>Iframe Example</title>
</head>
<body>
  <h1>Iframe Example</h1>
  <iframe id="myIframe"
  sandbox="allow-scripts allow-same-origin"
  allow="accelerometer; camera; microphone"
  src="https://staging.id.sonio-group.com/start/en/649025e334a855cf37cf58c7/?session=684c16dc96b6e11f5d160caa&flowid=66e15fd5fc3cc812ec550850" style="width: 100%; height: 600px;"></iframe>

  <script>
    // Listen for postMessage events
    window.addEventListener('message', function(event) {
      // Security check - validate the origin
      if (event.origin !== 'https://staging.id.sonio-group.com') {
        console.warn('Untrusted origin:', event.origin);
        return;
      }
      // Log the received message
      console.log('Message received from iframe:', event.data);
    }, false);
  </script>
</body>
</html>
