<?php
	$config = array(
		'goodsImg' => array(
			'upload_path' => './public/upload/goodsImg',
			'allowed_types' => 'gif|jpg|png|jpeg',
			'file_name' => substr(md5(time()),0,10),
			'max_size' => 2*1024*1024,
			'max_width' => 0,
			'max_height' => 0
		),
		'shopsImg' => array(
			'upload_path' => './public/upload/shopsImg',
			'allowed_types' => 'gif|jpg|png|jpeg',
			'file_name' => substr(md5(time()),0,10),
			'max_size' => 2*1024*1024,
			'max_width' => 0,
			'max_height' => 0
		),
		'scanPreview' => array(
			'upload_path' => './public/upload/userImg',
			'allowed_types' => 'gif|jpg|png|jpeg',
			'file_name' => substr(md5(time()),0,10),
			'max_size' => 2*1024*1024,
			'max_width' => 0,
			'max_height' => 0
		),
		'commentImg' => array(
			'upload_path' => './public/upload/commentImg',
			'allowed_types' => 'gif|jpg|png|jpeg',
			'file_name' => substr(md5(time()),0,10),
			'max_size' => 2*1024*1024,
			'max_width' => 0,
			'max_height' => 0

		)
	);