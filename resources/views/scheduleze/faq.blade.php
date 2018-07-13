@extends('layouts.front')

@section('content')
<div class="banner_section">
     	<div class="container">
   			<h2>Scheduleze Details</h2> 
	       	<p>Answers to common questions about Scheduleze</p>     
     	</div>
   	</div>

   	<div class="content_section">
     	<div class="container">
      		<div class="content_left">
       			<h3>How much does Scheduleze cost?</h3> 
       			<p>How many calls have you missed in the last year? If you book only handful of additional appointments per year, your Scheduleze subscription will pay for itself. We charge a reoccurring monthly subscription fee starting at $75.</p>
       			<p>The administrator on the account may add and configure additional employees as needed. Each additional employee/user incurs a $10 monthly fee. Package pricing is available for large multi-user clients. Fees for the coming month are automatically billed to the credit card on file at the first of each month.</p>

      			<h3>What does the service include?</h3>
      			<p>The main software package and everything it takes to get you started regardless of your current web presence. If you have a fully developed website already see the <a href="#">web integration</a> FAQ below. If you don't have a website currently see the <a href="#">no website</a> FAQ for more details.</p>

      			<h3>Can Scheduleze integrate with my existing website?</h3>
      			<p>Yes. Choose "I want Scheduleze integrated on my website" when you sign up. Level 2 and 3 of our pricing includes integrating your sites graphic style into the scheduler pages and we'll provide you with server-appropriate code snippets and documentation a qualified webmaster would need to integrate Scheduleze directly into your website's home page. Either let us know when you sign up, or contact <a href="#">support@Scheduleze.com</a> at anytime after your sign up to request assistance. We're here to make your Scheduleze experience as smooth as possible. </p>
      			<p>The Scheduleze front-end user forms are compatible with all server software packages including Microsoft IIS, Linux and FreeBSD webservers. Scheduleze integration will require that you have access to upload your modified web page and run simple include scripts (standard on most hosting accounts).</p>

      			<h3>What if I don't have my own website?</h3>
      			<p>Scheduleze is for you. When you sign up, a mini-site will be created for you. Clients access your schedule by going to www.Scheduleze.com/username, such as www.Scheduleze.com/parsons. Customers see your name, and contact information, as well as the scheduling form on your front page. It is possible to customize the look and feel of your Scheduleze home page, although this requires some knowledge of proper web HTML and image preparation techniques. If you desire graphical customization, contact <a href="#">support@Scheduleze.com</a> after you sign up to discuss the best solution for you.</p>

      			<h3>Can I add more locations later?</h3>
      			<p>Yes. You can add/edit/remove the locations you serve at anytime. You can also change the drive time from one location to another to adjust for road construction delays, seasonal congestion and other factors that change over time.</p>

      			<h3>How do you know what my drive time will be?</h3>
      			<p>After sign up, you'll be taken to our secure <a href="#">administration suite</a> where you specify the locations you serve and the drive time between each of them. Scheduleze then uses these times to compute the necessary time to allot for each appointment.</p>
      			<p>You may also wish to invoke the "Prevent zigzagging" feature on your administrative drivetimes page which will prevent you from being booked on one side of town, then the other, and then back again. Login to the <a href="#">administration demo</a> to see more details.</p>


      			<h3>How does the Document posting work?</h3>
      			<p>Once an appointment is completed, you may login to your Scheduleze account and choose to assocation a document with the appointment. You'll be asked to choose the appointment to which the file corresponds and then you'll browse your computer for the electronic file. Scheduleze will upload the document from your desktop and email the client and up to 4 recipients with a secure link to download the electronic file.</p>
      			<p>You can specify an expiration date for the download, so recipients won't be able to download old files after a certain time frame (2 weeks by default). Post your own documents now file at the <a href="#">administration demo</a>.</p>


      			<h3>Can I take days off?</h3>
      			<p>Yes. You have complete control of your schedule. Using the Scheduleze <a href="#">administration suite</a>, you specify what days you work, and which hours. In addition to standard business hours, you can specify an unlimited number of recurring blockouts, such as the second Tuesday of each month between 4pm and 6pm and an unlimited number of one-time blockouts such as next Wednesday's dentist appointment.</p>
      			<p>Clients never see your complete schedule, they are only offered available times that don't conflict with the blockouts and business hours that you specify. If you don't want to work Friday's block them out and no one will know whether you are working or golfing. See <a href="#">administration demo</a> for more details.</p>


      			<h3>Can I override a booking?</h3>
      			<p>Yes. You have complete control. You can edit, remove or manually add appointments to your schedule using the Scheduleze <a href="#">administration suite</a>.</p>

      			<h3>Can Scheduleze grow with my business?</h3>
      			<p>Yes. Many of our customers start on their own with fairly open schedules. However, as your business grows efficient time management becomes essential to your success.</p>
      			<p>When you decide to hire another employee, or partner with a colleague, you simply login to the Scheduleze <a href="#">administration suite</a> and choose "add new user ". You can specify this user's username and password. The new employee can login and add their own blockouts, days off etc. Or you, as the "administrator" can also review/edit their appointments and blockouts at will and change passwords, phone numbers etc.</p>

      		</div>
      		<div class="content_right">
       			<h2>Frequently Asked Questions</h2> 
		        <ul>
		          	<li><a href="#">Administration Demo</a></li>
		          	<li><a href="#">Setup and monthly cost</a></li>
		          	<li><a href="#">What's included</a></li>
		          	<li><a href="#">Integration into your website</a></li>
		          	<li><a href="#">If you don't have a website</a></li>
		          	<li><a href="#">Location management </a></li>    

		          	<li><a href="#">Drive time computation </a></li>
		          	<li><a href="#">PDF Reports uploading  </a></li>
		          	<li><a href="#">Taking Days off  </a></li>
		          	<li><a href="#">Booking override  </a></li>
		          	<li><a href="#">Business expansion  </a></li>
		          	
		        </ul> 
      		</div>     
     	</div>
   	</div>
@endsection
