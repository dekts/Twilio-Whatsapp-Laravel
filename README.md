# Twilio-Whatsapp-Laravel
Programmable SMS Quickstart &amp; Twilio Autopilot

<h3>Requirements</h3>

<li>PHP 7 development environment</li>
<li>Global installation of <a href="https://getcomposer.org/doc/00-intro.md" target="__blank">Composer</a></li>
<li>Global installation of <a href="https://ngrok.com/download" target="__blank">ngrok</a></li>
<li><a href="https://www.twilio.com/try-twilio" target="__blank">Twilio Account</a></li>
<li><a href="https://accounts.google.com/signup/v2/webcreateaccount?hl=en&flowName=GlifWebSignIn&flowEntry=SignUp" target="__blank">Google Account</a></li>
<li><a href="https://www.whatsapp.com/join/" target="__blank">WhatsApp Account</a></li>

<h3>Init Commands</h3>

`sudo cp demo_credentials.json credentials.json`

`sudo cp .env.example .env`

`composer install`

Then update the `.env` file based on google project and if you have `crdentials.json` file already then only you have to replace the file in this directory.

<h3>Start ngrok</h3>

We will need our `webhook.php` file to be accessible through a public URL. To do this we will use <a href="https://ngrok.com/download" target="__blank">ngrok</a>. From your terminal run the command:

`php -S localhost:3000`

On a new terminal window, goto root file of ngrok and run the command:

`./ngrok http 3000`

<h3>Set Up Autopilot Assistant</h3>

From your Twilio account, head over to the Autopilot console and create a new assistant. I’ve named mine <b>my-google-project</b>.

https://www.twilio.com/console/autopilot/list

<h4>Twilio Sandbox for WhatsApp</h4>

Since we will be using WhatsApp as our Autopilot channel, we need to set up our WhatsApp sandbox. On the left, click channels and select WhatsApp.

Setup using: https://www.twilio.com/docs/autopilot/channels/whatsapp

Thanks, and let me know if you have any queries.