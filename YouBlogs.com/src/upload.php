<?php
	require 'Cloudinary.php';
	require 'Uploader.php';
	require 'Api.php';


	\Cloudinary::config(array( 
  	"cloud_name" => "dr8r92oou", 
  	"api_key" => "576724674741138", 
  	"api_secret" => "oIwR8vYo97e8Jystj15O86lEiWE" 
	));

	\Cloudinary\Uploader::upload("/home/ben/Pictures/avatar.jpg",array("public_id" => "sample_id"));


