@extends('layouts.wura')
@section('page_heading', "Card's Information")

@section('styles')
   <style>
        /* -------------------------------- 

        Primary style

        -------------------------------- */
        html * {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        }

        *, *:after, *:before {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        }

        body {
        font-size: 100%;
        font-family: "Droid Serif", serif;
        color: #7f8c97;
        background-color: #e9f0f5;
        }

        a {
        color: #acb7c0;
        text-decoration: none;
        font-family: "Open Sans", sans-serif;
        }

        img {
        max-width: 100%;
        }

        h1, h2 {
        font-family: "Open Sans", sans-serif;
        font-weight: bold;
        }

        /* -------------------------------- 

        Modules - reusable parts of our design

        -------------------------------- */
        .cd-container {
        /* this class is used to give a max-width to the element it is applied to, and center it horizontally when it reaches that max-width */
        width: 90%;
        max-width: 1170px;
        margin: 0 auto;
        }
        .cd-container::after {
        /* clearfix */
        content: '';
        display: table;
        clear: both;
        }

        /* -------------------------------- 

        xnugget info 

        -------------------------------- */
        .cd-nugget-info {
        text-align: center;
        position: absolute;
        width: 100%;
        height: 50px;
        line-height: 50px;
        top: 0;
        left: 0;
        }
        .cd-nugget-info a {
        position: relative;
        font-size: 14px;
        color: #718ca1;
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        transition: all 0.2s;
        }
        .no-touch .cd-nugget-info a:hover {
        opacity: .8;
        }
        .cd-nugget-info span {
        vertical-align: middle;
        display: inline-block;
        }
        .cd-nugget-info span svg {
        display: block;
        }
        .cd-nugget-info .cd-nugget-info-arrow {
        fill: #718ca1;
        }

        /* -------------------------------- 

        xcarbonads 

        -------------------------------- */
        #carbonads-container,
        #ui8ads-container {
        position: fixed;
        right: 40px;
        top: 40px;
        width: 180px;
        display: none;
        z-index: 1;
        }
        #carbonads-container .close-carbon-adv,
        #carbonads-container .close-ui8-adv,
        #ui8ads-container .close-carbon-adv,
        #ui8ads-container .close-ui8-adv {
        display: inline-block;
        position: absolute;
        top: 0;
        right: 100%;
        background: rgba(26, 34, 40, 0.8);
        text-indent: 100%;
        overflow: hidden;
        width: 32px;
        height: 32px;
        border-radius: 3px 0 0 3px;
        }
        #carbonads-container .close-carbon-adv:hover,
        #carbonads-container .close-ui8-adv:hover,
        #ui8ads-container .close-carbon-adv:hover,
        #ui8ads-container .close-ui8-adv:hover {
        background: #1a2228;
        }
        #carbonads-container .close-carbon-adv::after, #carbonads-container .close-carbon-adv::before,
        #carbonads-container .close-ui8-adv::after,
        #carbonads-container .close-ui8-adv::before,
        #ui8ads-container .close-carbon-adv::after,
        #ui8ads-container .close-carbon-adv::before,
        #ui8ads-container .close-ui8-adv::after,
        #ui8ads-container .close-ui8-adv::before {
        content: '';
        background-color: #fff;
        height: 2px;
        width: 14px;
        position: absolute;
        top: 14px;
        left: 9px;
        }
        #carbonads-container .close-carbon-adv::after,
        #carbonads-container .close-ui8-adv::after,
        #ui8ads-container .close-carbon-adv::after,
        #ui8ads-container .close-ui8-adv::after {
        -webkit-transform: rotate(45deg);
        -moz-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        transform: rotate(45deg);
        }
        #carbonads-container .close-carbon-adv::before,
        #carbonads-container .close-ui8-adv::before,
        #ui8ads-container .close-carbon-adv::before,
        #ui8ads-container .close-ui8-adv::before {
        -webkit-transform: rotate(-45deg);
        -moz-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        -o-transform: rotate(-45deg);
        transform: rotate(-45deg);
        }
        #carbonads-container .carbonad,
        #carbonads-container .ui8ad,
        #ui8ads-container .carbonad,
        #ui8ads-container .ui8ad {
        background: rgba(255, 255, 255, 0.9);
        border: none;
        width: 100%;
        height: auto;
        padding: 14px;
        text-align: center;
        border-radius: 0 3px 3px 3px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        #carbonads-container .carbonad .carbonad-image img,
        #carbonads-container .carbonad .ui8ad-image img,
        #carbonads-container .ui8ad .carbonad-image img,
        #carbonads-container .ui8ad .ui8ad-image img,
        #ui8ads-container .carbonad .carbonad-image img,
        #ui8ads-container .carbonad .ui8ad-image img,
        #ui8ads-container .ui8ad .carbonad-image img,
        #ui8ads-container .ui8ad .ui8ad-image img {
        width: 130px;
        }
        #carbonads-container .carbonad .carbonad-image img,
        #carbonads-container .ui8ad .carbonad-image img,
        #ui8ads-container .carbonad .carbonad-image img,
        #ui8ads-container .ui8ad .carbonad-image img {
        margin: 0 0 10px 10px;
        }
        #carbonads-container .carbonad .ui8ad-image img,
        #carbonads-container .carbonad .carbon-img img,
        #carbonads-container .ui8ad .ui8ad-image img,
        #carbonads-container .ui8ad .carbon-img img,
        #ui8ads-container .carbonad .ui8ad-image img,
        #ui8ads-container .carbonad .carbon-img img,
        #ui8ads-container .ui8ad .ui8ad-image img,
        #ui8ads-container .ui8ad .carbon-img img {
        margin: 0 10px 10px;
        width: 130px;
        }
        #carbonads-container .carbonad .carbon-text, #carbonads-container .carbonad .carbonad-tag,
        #carbonads-container .carbonad .carbon-poweredby,
        #carbonads-container .carbonad .ui8ad-text, #carbonads-container .carbonad .ui8ad-tag,
        #carbonads-container .ui8ad .carbon-text,
        #carbonads-container .ui8ad .carbonad-tag,
        #carbonads-container .ui8ad .carbon-poweredby,
        #carbonads-container .ui8ad .ui8ad-text,
        #carbonads-container .ui8ad .ui8ad-tag,
        #ui8ads-container .carbonad .carbon-text,
        #ui8ads-container .carbonad .carbonad-tag,
        #ui8ads-container .carbonad .carbon-poweredby,
        #ui8ads-container .carbonad .ui8ad-text,
        #ui8ads-container .carbonad .ui8ad-tag,
        #ui8ads-container .ui8ad .carbon-text,
        #ui8ads-container .ui8ad .carbonad-tag,
        #ui8ads-container .ui8ad .carbon-poweredby,
        #ui8ads-container .ui8ad .ui8ad-text,
        #ui8ads-container .ui8ad .ui8ad-tag {
        font-family: 'Helvetica Neue', Arial, sans-serif;
        }
        #carbonads-container .carbonad .carbon-wrap,
        #carbonads-container .carbonad .ui8ad-text,
        #carbonads-container .ui8ad .carbon-wrap,
        #carbonads-container .ui8ad .ui8ad-text,
        #ui8ads-container .carbonad .carbon-wrap,
        #ui8ads-container .carbonad .ui8ad-text,
        #ui8ads-container .ui8ad .carbon-wrap,
        #ui8ads-container .ui8ad .ui8ad-text {
        display: block;
        width: 100%;
        padding: 0;
        }
        #carbonads-container .carbonad .carbon-wrap a,
        #carbonads-container .carbonad .ui8ad-text a,
        #carbonads-container .ui8ad .carbon-wrap a,
        #carbonads-container .ui8ad .ui8ad-text a,
        #ui8ads-container .carbonad .carbon-wrap a,
        #ui8ads-container .carbonad .ui8ad-text a,
        #ui8ads-container .ui8ad .carbon-wrap a,
        #ui8ads-container .ui8ad .ui8ad-text a {
        color: #c23941;
        font-size: 13px;
        font-weight: bold;
        }
        .no-touch #carbonads-container .carbonad .carbon-wrap a:hover, .no-touch
        #carbonads-container .carbonad .ui8ad-text a:hover, .no-touch
        #carbonads-container .ui8ad .carbon-wrap a:hover, .no-touch
        #carbonads-container .ui8ad .ui8ad-text a:hover, .no-touch
        #ui8ads-container .carbonad .carbon-wrap a:hover, .no-touch
        #ui8ads-container .carbonad .ui8ad-text a:hover, .no-touch
        #ui8ads-container .ui8ad .carbon-wrap a:hover, .no-touch
        #ui8ads-container .ui8ad .ui8ad-text a:hover {
        text-decoration: underline;
        }
        #carbonads-container .carbonad .carbonad-tag,
        #carbonads-container .carbonad .carbon-poweredby,
        #carbonads-container .carbonad .ui8ad-tag,
        #carbonads-container .ui8ad .carbonad-tag,
        #carbonads-container .ui8ad .carbon-poweredby,
        #carbonads-container .ui8ad .ui8ad-tag,
        #ui8ads-container .carbonad .carbonad-tag,
        #ui8ads-container .carbonad .carbon-poweredby,
        #ui8ads-container .carbonad .ui8ad-tag,
        #ui8ads-container .ui8ad .carbonad-tag,
        #ui8ads-container .ui8ad .carbon-poweredby,
        #ui8ads-container .ui8ad .ui8ad-tag {
        margin-top: 5px;
        color: #3a393f;
        }
        #carbonads-container .carbonad .carbonad-tag a,
        #carbonads-container .carbonad .carbon-poweredby a,
        #carbonads-container .carbonad .ui8ad-tag a,
        #carbonads-container .ui8ad .carbonad-tag a,
        #carbonads-container .ui8ad .carbon-poweredby a,
        #carbonads-container .ui8ad .ui8ad-tag a,
        #ui8ads-container .carbonad .carbonad-tag a,
        #ui8ads-container .carbonad .carbon-poweredby a,
        #ui8ads-container .carbonad .ui8ad-tag a,
        #ui8ads-container .ui8ad .carbonad-tag a,
        #ui8ads-container .ui8ad .carbon-poweredby a,
        #ui8ads-container .ui8ad .ui8ad-tag a {
        color: #3a393f;
        }
        #carbonads-container .carbonad .carbonad-tag a:hover,
        #carbonads-container .carbonad .carbon-poweredby a:hover,
        #carbonads-container .carbonad .ui8ad-tag a:hover,
        #carbonads-container .ui8ad .carbonad-tag a:hover,
        #carbonads-container .ui8ad .carbon-poweredby a:hover,
        #carbonads-container .ui8ad .ui8ad-tag a:hover,
        #ui8ads-container .carbonad .carbonad-tag a:hover,
        #ui8ads-container .carbonad .carbon-poweredby a:hover,
        #ui8ads-container .carbonad .ui8ad-tag a:hover,
        #ui8ads-container .ui8ad .carbonad-tag a:hover,
        #ui8ads-container .ui8ad .carbon-poweredby a:hover,
        #ui8ads-container .ui8ad .ui8ad-tag a:hover {
        color: #c23941;
        }
        #carbonads-container .carbonad .ui8ad-tag,
        #carbonads-container .carbonad .carbon-poweredby,
        #carbonads-container .ui8ad .ui8ad-tag,
        #carbonads-container .ui8ad .carbon-poweredby,
        #ui8ads-container .carbonad .ui8ad-tag,
        #ui8ads-container .carbonad .carbon-poweredby,
        #ui8ads-container .ui8ad .ui8ad-tag,
        #ui8ads-container .ui8ad .carbon-poweredby {
        display: inline-block;
        font-size: 11px;
        line-height: 15px;
        }

        @media only screen and (min-width: 1170px) {
        #carbonads-container,
        #ui8ads-container {
            display: block;
        }
        }

        /* -------------------------------- 

        Main components 

        -------------------------------- */
        header {
        height: 200px;
        line-height: 200px;
        text-align: center;
        background: #303e49;
        }
        header h1 {
        color: white;
        font-size: 18px;
        font-size: 1.125rem;
        }

        @media only screen and (min-width: 1170px) {
        header {
            height: 300px;
            line-height: 300px;
        }
        header h1 {
            font-size: 24px;
            font-size: 1.5rem;
        }
        }

        #cd-timeline {
        position: relative;
        padding: 2em 0;
        margin-top: 2em;
        margin-bottom: 2em;
        }
        #cd-timeline::before {
        /* this is the vertical line */
        content: '';
        position: absolute;
        top: 0;
        left: 18px;
        height: 100%;
        width: 4px;
        background: #d7e4ed;
        }

        @media only screen and (min-width: 1170px) {
        #cd-timeline {
            margin-top: 3em;
            margin-bottom: 3em;
        }
        #cd-timeline::before {
            left: 50%;
            margin-left: -2px;
        }
        }

        .cd-timeline-block {
        position: relative;
        margin: 2em 0;
        }
        .cd-timeline-block:after {
        content: "";
        display: table;
        clear: both;
        }
        .cd-timeline-block:first-child {
        margin-top: 0;
        }
        .cd-timeline-block:last-child {
        margin-bottom: 0;
        }

        @media only screen and (min-width: 1170px) {
        .cd-timeline-block {
            margin: 4em 0;
        }
        .cd-timeline-block:first-child {
            margin-top: 0;
        }
        .cd-timeline-block:last-child {
            margin-bottom: 0;
        }
        }

        .cd-timeline-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        box-shadow: 0 0 0 4px white, inset 0 2px 0 rgba(0, 0, 0, 0.08), 0 3px 0 4px rgba(0, 0, 0, 0.05);
        }
        .cd-timeline-img img {
        display: block;
        width: 24px;
        height: 24px;
        position: relative;
        left: 50%;
        top: 50%;
        margin-left: -12px;
        margin-top: -12px;
        }
        .cd-timeline-img.cd-picture {
        background: #75ce66;
        }
        .cd-timeline-img.cd-movie {
        background: #c03b44;
        }
        .cd-timeline-img.cd-location {
        background: #f0ca45;
        }

        @media only screen and (min-width: 1170px) {
        .cd-timeline-img {
            width: 60px;
            height: 60px;
            left: 50%;
            margin-left: -30px;
            /* Force Hardware Acceleration in WebKit */
            -webkit-transform: translateZ(0);
            -webkit-backface-visibility: hidden;
        }
        .cssanimations .cd-timeline-img.is-hidden {
            visibility: hidden;
        }
        .cssanimations .cd-timeline-img.bounce-in {
            visibility: visible;
            -webkit-animation: cd-bounce-1 0.6s;
            -moz-animation: cd-bounce-1 0.6s;
            animation: cd-bounce-1 0.6s;
        }
        }

        @-webkit-keyframes cd-bounce-1 {
        0% {
            opacity: 0;
            -webkit-transform: scale(0.5);
        }

        60% {
            opacity: 1;
            -webkit-transform: scale(1.2);
        }

        100% {
            -webkit-transform: scale(1);
        }
        }

        @-moz-keyframes cd-bounce-1 {
        0% {
            opacity: 0;
            -moz-transform: scale(0.5);
        }

        60% {
            opacity: 1;
            -moz-transform: scale(1.2);
        }

        100% {
            -moz-transform: scale(1);
        }
        }

        @keyframes cd-bounce-1 {
        0% {
            opacity: 0;
            -webkit-transform: scale(0.5);
            -moz-transform: scale(0.5);
            -ms-transform: scale(0.5);
            -o-transform: scale(0.5);
            transform: scale(0.5);
        }

        60% {
            opacity: 1;
            -webkit-transform: scale(1.2);
            -moz-transform: scale(1.2);
            -ms-transform: scale(1.2);
            -o-transform: scale(1.2);
            transform: scale(1.2);
        }

        100% {
            -webkit-transform: scale(1);
            -moz-transform: scale(1);
            -ms-transform: scale(1);
            -o-transform: scale(1);
            transform: scale(1);
        }
        }
        .cd-timeline-content {
        position: relative;
        margin-left: 60px;
        background: white;
        border-radius: 0.25em;
        padding: 1em;
        box-shadow: 0 3px 0 #d7e4ed;
        }
        .cd-timeline-content:after {
        content: "";
        display: table;
        clear: both;
        }
        .cd-timeline-content h2 {
        color: #303e49;
        }
        .cd-timeline-content p, .cd-timeline-content .cd-read-more, .cd-timeline-content .cd-date {
        font-size: 13px;
        font-size: 0.8125rem;
        }
        .cd-timeline-content .cd-read-more, .cd-timeline-content .cd-date {
        display: inline-block;
        }
        .cd-timeline-content p {
        margin: 1em 0;
        line-height: 1.6;
        }
        .cd-timeline-content .cd-read-more {
        float: right;
        padding: .8em 1em;
        background: #acb7c0;
        color: white;
        border-radius: 0.25em;
        }
        .no-touch .cd-timeline-content .cd-read-more:hover {
        background-color: #bac4cb;
        }
        .cd-timeline-content .cd-date {
        float: left;
        padding: .8em 0;
        opacity: .7;
        }
        .cd-timeline-content::before {
        content: '';
        position: absolute;
        top: 16px;
        right: 100%;
        height: 0;
        width: 0;
        border: 7px solid transparent;
        border-right: 7px solid white;
        }
        @media only screen and (min-width: 768px) {
        .cd-timeline-content h2 {
            font-size: 20px;
            font-size: 1.25rem;
        }
        .cd-timeline-content p {
            font-size: 16px;
            font-size: 1rem;
        }
        .cd-timeline-content .cd-read-more, .cd-timeline-content .cd-date {
            font-size: 14px;
            font-size: 0.875rem;
        }
        }

        @media only screen and (min-width: 1170px) {
        .cd-timeline-content {
            margin-left: 0;
            padding: 1.6em;
            width: 45%;
        }
        .cd-timeline-content::before {
            top: 24px;
            left: 100%;
            border-color: transparent;
            border-left-color: white;
        }
        .cd-timeline-content .cd-read-more {
            float: left;
        }
        .cd-timeline-content .cd-date {
            position: absolute;
            width: 100%;
            left: 80%; /* 122%; */
            top: 6px;
            font-size: 16px;
            font-size: 1rem;
        }
        .cd-timeline-block:nth-child(even) .cd-timeline-content {
            float: right;
        }
        .cd-timeline-block:nth-child(even) .cd-timeline-content::before {
            top: 24px;
            left: auto;
            right: 100%;
            border-color: transparent;
            border-right-color: white;
        }
        .cd-timeline-block:nth-child(even) .cd-timeline-content .cd-read-more {
            float: right;
        }
        .cd-timeline-block:nth-child(even) .cd-timeline-content .cd-date {
            left: auto;
            right: 122%;
            text-align: right;
        }
        .cssanimations .cd-timeline-content.is-hidden {
            visibility: hidden;
        }
        .cssanimations .cd-timeline-content.bounce-in {
            visibility: visible;
            -webkit-animation: cd-bounce-2 0.6s;
            -moz-animation: cd-bounce-2 0.6s;
            animation: cd-bounce-2 0.6s;
        }
        }

        @media only screen and (min-width: 1170px) {
        /* inverse bounce effect on even content blocks */
        .cssanimations .cd-timeline-block:nth-child(even) .cd-timeline-content.bounce-in {
            -webkit-animation: cd-bounce-2-inverse 0.6s;
            -moz-animation: cd-bounce-2-inverse 0.6s;
            animation: cd-bounce-2-inverse 0.6s;
        }
        }

        @-webkit-keyframes cd-bounce-2 {
        0% {
            opacity: 0;
            -webkit-transform: translateX(-100px);
        }

        60% {
            opacity: 1;
            -webkit-transform: translateX(20px);
        }

        100% {
            -webkit-transform: translateX(0);
        }
        }

        @-moz-keyframes cd-bounce-2 {
        0% {
            opacity: 0;
            -moz-transform: translateX(-100px);
        }

        60% {
            opacity: 1;
            -moz-transform: translateX(20px);
        }

        100% {
            -moz-transform: translateX(0);
        }
        }

        @keyframes cd-bounce-2 {
        0% {
            opacity: 0;
            -webkit-transform: translateX(-100px);
            -moz-transform: translateX(-100px);
            -ms-transform: translateX(-100px);
            -o-transform: translateX(-100px);
            transform: translateX(-100px);
        }

        60% {
            opacity: 1;
            -webkit-transform: translateX(20px);
            -moz-transform: translateX(20px);
            -ms-transform: translateX(20px);
            -o-transform: translateX(20px);
            transform: translateX(20px);
        }

        100% {
            -webkit-transform: translateX(0);
            -moz-transform: translateX(0);
            -ms-transform: translateX(0);
            -o-transform: translateX(0);
            transform: translateX(0);
        }
        }

        @-webkit-keyframes cd-bounce-2-inverse {
        0% {
            opacity: 0;
            -webkit-transform: translateX(100px);
        }

        60% {
            opacity: 1;
            -webkit-transform: translateX(-20px);
        }

        100% {
            -webkit-transform: translateX(0);
        }
        }

        @-moz-keyframes cd-bounce-2-inverse {
        0% {
            opacity: 0;
            -moz-transform: translateX(100px);
        }

        60% {
            opacity: 1;
            -moz-transform: translateX(-20px);
        }

        100% {
            -moz-transform: translateX(0);
        }
        }

        @keyframes cd-bounce-2-inverse {
        0% {
            opacity: 0;
            -webkit-transform: translateX(100px);
            -moz-transform: translateX(100px);
            -ms-transform: translateX(100px);
            -o-transform: translateX(100px);
            transform: translateX(100px);
        }

        60% {
            opacity: 1;
            -webkit-transform: translateX(-20px);
            -moz-transform: translateX(-20px);
            -ms-transform: translateX(-20px);
            -o-transform: translateX(-20px);
            transform: translateX(-20px);
        }

        100% {
            -webkit-transform: translateX(0);
            -moz-transform: translateX(0);
            -ms-transform: translateX(0);
            -o-transform: translateX(0);
            transform: translateX(0);
        }
        }
   </style>
@stop

@section('content')

    <!-- <div class="row">

        <div class="col-md-12">
        
        </div>

    </div> -->

    <section id="cd-timeline" class="cd-container">
		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<img src="images/cd-icon-picture.svg" alt="Picture">
			</div> <!-- cd-timeline-img -->

			<div class="cd-timeline-content">
				<h2>Title of section 1</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
				<a href="#0" class="cd-read-more">Read more</a>
				<span class="cd-date">Jan 14</span>
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-movie">
				<img src="images/cd-icon-movie.svg" alt="Movie">
			</div> <!-- cd-timeline-img -->

			<div class="cd-timeline-content">
				<h2>Title of section 2</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde?</p>
				<a href="#0" class="cd-read-more">Read more</a>
				<span class="cd-date">Jan 18</span>
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-picture">
				<img src="images/cd-icon-picture.svg" alt="Picture">
			</div> <!-- cd-timeline-img -->

			<div class="cd-timeline-content">
				<h2>Title of section 3</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, obcaecati, quisquam id molestias eaque asperiores voluptatibus cupiditate error assumenda delectus odit similique earum voluptatem doloremque dolorem ipsam quae rerum quis. Odit, itaque, deserunt corporis vero ipsum nisi eius odio natus ullam provident pariatur temporibus quia eos repellat consequuntur perferendis enim amet quae quasi repudiandae sed quod veniam dolore possimus rem voluptatum eveniet eligendi quis fugiat aliquam sunt similique aut adipisci.</p>
				<a href="#0" class="cd-read-more">Read more</a>
				<span class="cd-date">Jan 24</span>
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-location">
				<img src="images/cd-icon-location.svg" alt="Location">
			</div> <!-- cd-timeline-img -->

			<div class="cd-timeline-content">
				<h2>Title of section 4</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
				<a href="#0" class="cd-read-more">Read more</a>
				<span class="cd-date">Feb 14</span>
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-location">
				<img src="images/cd-icon-location.svg" alt="Location">
			</div> <!-- cd-timeline-img -->

			<div class="cd-timeline-content">
				<h2>Title of section 5</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum.</p>
				<a href="#0" class="cd-read-more">Read more</a>
				<span class="cd-date">Feb 18</span>
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->

		<div class="cd-timeline-block">
			<div class="cd-timeline-img cd-movie">
				<img src="images/cd-icon-movie.svg" alt="Movie">
			</div> <!-- cd-timeline-img -->

			<div class="cd-timeline-content">
				<h2>Final Section</h2>
				<p>This is the content of the last section</p>
				<span class="cd-date">Feb 26</span>
			</div> <!-- cd-timeline-content -->
		</div> <!-- cd-timeline-block -->
	</section> <!-- cd-timeline -->

@endsection

@section('scripts')
    <script>
        jQuery(document).ready(function($){
            var timelineBlocks = $('.cd-timeline-block'),
                offset = 0.8;

            // hide timeline blocks which are outside the viewport
            hideBlocks(timelineBlocks, offset);

            //on scolling, show/animate timeline blocks when enter the viewport
            $(window).on('scroll', function(){
                (!window.requestAnimationFrame) 
                    ? setTimeout(function(){ showBlocks(timelineBlocks, offset); }, 100)
                    : window.requestAnimationFrame(function(){ showBlocks(timelineBlocks, offset); });
            });

            function hideBlocks(blocks, offset) {
                blocks.each(function(){
                    ( $(this).offset().top > $(window).scrollTop()+$(window).height()*offset ) && $(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden');
                });
            }

            function showBlocks(blocks, offset) {
                blocks.each(function(){
                    ( $(this).offset().top <= $(window).scrollTop()+$(window).height()*offset && $(this).find('.cd-timeline-img').hasClass('is-hidden') ) && $(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
                });
            }
        });
    </script>
@stop