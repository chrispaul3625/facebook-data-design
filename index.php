<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Facebook data Model </title>
		<h1> Facebook Data Model </h1>
		<img src="images/erd.svg" alt="erd table">
	</head>
	<body>
		<header>
			<h1>Persona </h1>
				<p>Nicole Jaramillo is a program coordinator at a local nonprofit here in Albuquerque. She is in charge of
				hiring at her company and likes to check a persons facebook prior to interviews to get an idea what the
				applicant is like. She often times likes to explore their timeline to see what kinds of things the applicant
				is into for fun, what kind of friends the applicant has, and other baisic information about the applicant
				that you wouldnt likely find on a resume.</p>
			<h1> Use Case </h1>
			<p> A user will log on to the website, they will be prompted to enter in their user name and password, they
			will enter in that information, at which point if they are succesful they will be directed to their timeline.
			The user can then scroll down the timeline and view various posts by their friends. The user can point and
			click on the posts to futher examine the posts content, likes, and comments, as well as be able to post a
			comment of their own or like the post as well. The user can also create posts themselves and share other users
			posts as well. The main goal of this part of the website is to allow the user to connect with friends, and
			to be able to share content among the users friends as well.</p>
			<h1> Backend </h1>
			<h3> Entities </h3>
			<p>
				<ul>
					<li> profile </li>
					<li> post </li>
				</ul>
			<h3> Weak Entities </h3>
				<ul>
				<li>liked</li>
			</ul>
			<h3> Attributes </h3>
				<ul>
					<li> profileName </li>
					<li> postContent </li>
					<li> postTime </li>
					<li> postId </li>
					<li> profileId </li>
					<li> timeLiked </li>
				</ul>
			<h3> Primary Keys</h3>
				<ul>
					<li> postId </li>
					<li> profileId </li>
				</ul>
			<h3> Foreign Attributes </h3>
				<ul>
					<li> write </li>
					<li> comment </li>
					<li> like </li>
					<li> likes </li>
				</ul>
			</p>
		</header>
	</body>
	</html>