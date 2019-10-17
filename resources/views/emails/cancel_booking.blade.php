<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Lumberjaxe</title>

	<style>
		.ql-container {
			box-sizing: border-box;
			font-family: Helvetica, Arial, sans-serif;
			font-size: 13px;
			height: 100%;
			margin: 0px;
			position: relative;
		}
		.ql-clipboard {
			left: -100000px;
			height: 1px;
			overflow-y: hidden;
			position: absolute;
			top: 50%;
		}
		.ql-clipboard p {
			margin: 0;
			padding: 0;
		}
		.ql-editor {
			box-sizing: border-box;
			line-height: 1.42;
			height: 100%;
			outline: none;
			overflow-y: auto;
			padding: 12px 15px;
			tab-size: 4;
			-moz-tab-size: 4;
			text-align: left;
			white-space: pre-wrap;
			word-wrap: break-word;
		}
		.ql-editor ol > li,
		.ql-editor ul > li {
			list-style-type: none;
		}
		.ql-editor ol li.ql-direction-rtl,
		.ql-editor ul li.ql-direction-rtl {
			padding-right: 1.5em;
		}
		.ql-editor ol li {
			counter-reset: list-1 list-2 list-3 list-4 list-5 list-6 list-7 list-8 list-9;
			counter-increment: list-0;
		}
		.ql-editor ol li.ql-indent-8 {
			counter-reset: list-9;
		}
		.ql-editor ol li.ql-indent-9 {
			counter-increment: list-9;
		}
		.ql-editor ol li.ql-indent-9:before {
			content: counter(list-9, decimal) '. ';
		}
		.ql-indent-1:not(.ql-direction-rtl) {
			padding-left: 3em;
		}
		.ql-editor li.ql-indent-1:not(.ql-direction-rtl) {
			padding-left: 4.5em;
		}
		.ql-indent-1.ql-direction-rtl.ql-align-right {
			padding-right: 3em;
		}
		.ql-editor li.ql-indent-1.ql-direction-rtl.ql-align-right {
			padding-right: 4.5em;
		}
		.ql-indent-2:not(.ql-direction-rtl) {
			padding-left: 6em;
		}
		.ql-editor li.ql-indent-2:not(.ql-direction-rtl) {
			padding-left: 7.5em;
		}
		.ql-indent-2.ql-direction-rtl.ql-align-right {
			padding-right: 6em;
		}
		.ql-editor li.ql-indent-2.ql-direction-rtl.ql-align-right {
			padding-right: 7.5em;
		}
		.ql-indent-3:not(.ql-direction-rtl) {
			padding-left: 9em;
		}
		.ql-editor li.ql-indent-3:not(.ql-direction-rtl) {
			padding-left: 10.5em;
		}
		.ql-indent-3.ql-direction-rtl.ql-align-right {
			padding-right: 9em;
		}
		.ql-editor li.ql-indent-3.ql-direction-rtl.ql-align-right {
			padding-right: 10.5em;
		}
		.ql-indent-4:not(.ql-direction-rtl) {
			padding-left: 12em;
		}
		.ql-editor li.ql-indent-4:not(.ql-direction-rtl) {
			padding-left: 13.5em;
		}
		.ql-indent-4.ql-direction-rtl.ql-align-right {
			padding-right: 12em;
		}
		.ql-editor li.ql-indent-4.ql-direction-rtl.ql-align-right {
			padding-right: 13.5em;
		}
		.ql-indent-5:not(.ql-direction-rtl) {
			padding-left: 15em;
		}
		.ql-editor li.ql-indent-5:not(.ql-direction-rtl) {
			padding-left: 16.5em;
		}
		.ql-indent-5.ql-direction-rtl.ql-align-right {
			padding-right: 15em;
		}
		.ql-editor li.ql-indent-5.ql-direction-rtl.ql-align-right {
			padding-right: 16.5em;
		}
		.ql-indent-6:not(.ql-direction-rtl) {
			padding-left: 18em;
		}
		.ql-editor li.ql-indent-6:not(.ql-direction-rtl) {
			padding-left: 19.5em;
		}
		.ql-indent-6.ql-direction-rtl.ql-align-right {
			padding-right: 18em;
		}
		.ql-editor li.ql-indent-6.ql-direction-rtl.ql-align-right {
			padding-right: 19.5em;
		}
		.ql-indent-7:not(.ql-direction-rtl) {
			padding-left: 21em;
		}
		.ql-editor li.ql-indent-7:not(.ql-direction-rtl) {
			padding-left: 22.5em;
		}
		.ql-indent-7.ql-direction-rtl.ql-align-right {
			padding-right: 21em;
		}
		.ql-editor li.ql-indent-7.ql-direction-rtl.ql-align-right {
			padding-right: 22.5em;
		}
		.ql-indent-8:not(.ql-direction-rtl) {
			padding-left: 24em;
		}
		.ql-editor li.ql-indent-8:not(.ql-direction-rtl) {
			padding-left: 25.5em;
		}
		.ql-indent-8.ql-direction-rtl.ql-align-right {
			padding-right: 24em;
		}
		.ql-editor li.ql-indent-8.ql-direction-rtl.ql-align-right {
			padding-right: 25.5em;
		}
		.ql-indent-9:not(.ql-direction-rtl) {
			padding-left: 27em;
		}
		.ql-editor li.ql-indent-9:not(.ql-direction-rtl) {
			padding-left: 28.5em;
		}
		.ql-indent-9.ql-direction-rtl.ql-align-right {
			padding-right: 27em;
		}
		.ql-editor li.ql-indent-9.ql-direction-rtl.ql-align-right {
			padding-right: 28.5em;
		}
		.ql-video {
			display: block;
			max-width: 100%;
		}
		.ql-video.ql-align-center {
			margin: 0 auto;
		}
		.ql-video.ql-align-right {
			margin: 0 0 0 auto;
		}
		.ql-bg-black {
			background-color: #000;
		}
		.ql-bg-red {
			background-color: #e60000;
		}
		.ql-bg-orange {
			background-color: #f90;
		}
		.ql-bg-yellow {
			background-color: #ff0;
		}
		.ql-bg-green {
			background-color: #008a00;
		}
		.ql-bg-blue {
			background-color: #06c;
		}
		.ql-bg-purple {
			background-color: #93f;
		}
		.ql-color-white {
			color: #fff;
		}
		.ql-color-red {
			color: #e60000;
		}
		.ql-color-orange {
			color: #f90;
		}
		.ql-color-yellow {
			color: #ff0;
		}
		.ql-color-green {
			color: #008a00;
		}
		.ql-color-blue {
			color: #06c;
		}
		.ql-color-purple {
			color: #93f;
		}
		.ql-font-serif {
			font-family: Georgia, Times New Roman, serif;
		}
		.ql-font-monospace {
			font-family: Monaco, Courier New, monospace;
		}
		.ql-size-small {
			font-size: 0.75em;
		}
		.ql-size-large {
			font-size: 1.5em;
		}
		.ql-size-huge {
			font-size: 2.5em;
		}
		.ql-direction-rtl {
			direction: rtl;
			text-align: inherit;
		}
		.ql-align-center {
			text-align: center;
		}
		.ql-align-justify {
			text-align: justify;
		}
		.ql-align-right {
			text-align: right;
		}
		.ql-bubble.ql-toolbar button,
		.ql-bubble .ql-toolbar button {
			background: none;
			border: none;
			cursor: pointer;
			display: inline-block;
			float: left;
			height: 24px;
			padding: 3px 5px;
			width: 28px;
		}
		.ql-bubble.ql-toolbar button svg,
		.ql-bubble .ql-toolbar button svg {
			float: left;
			height: 100%;
		}
		.ql-bubble {
			box-sizing: border-box;
		}
		.ql-bubble * {
			box-sizing: border-box;
		}
		.ql-bubble .ql-hidden {
			display: none;
		}
		.ql-bubble .ql-out-bottom,
		.ql-bubble .ql-out-top {
			visibility: hidden;
		}
		.ql-bubble .ql-tooltip {
			position: absolute;
			transform: translateY(10px);
		}
		.ql-bubble .ql-tooltip a {
			cursor: pointer;
			text-decoration: none;
		}
		.ql-bubble .ql-tooltip.ql-flip {
			transform: translateY(-10px);
		}
		.ql-bubble .ql-formats {
			display: inline-block;
			vertical-align: middle;
		}
		.ql-bubble .ql-formats:after {
			clear: both;
			content: '';
			display: table;
		}
		.ql-bubble .ql-stroke {
			fill: none;
			stroke: #ccc;
			stroke-linecap: round;
			stroke-linejoin: round;
			stroke-width: 2;
		}
		.ql-bubble .ql-stroke-miter {
			fill: none;
			stroke: #ccc;
			stroke-miterlimit: 10;
			stroke-width: 2;
		}
		.ql-bubble .ql-fill,
		.ql-bubble .ql-stroke.ql-fill {
			fill: #ccc;
		}
		.ql-bubble .ql-empty {
			fill: none;
		}
		.ql-bubble .ql-even {
			fill-rule: evenodd;
		}
		.ql-bubble .ql-thin,
		.ql-bubble .ql-stroke.ql-thin {
			stroke-width: 1;
		}
		.ql-bubble .ql-transparent {
			opacity: 0.4;
		}
		.ql-bubble .ql-direction svg:last-child {
			display: none;
		}
		.ql-bubble .ql-direction.ql-active svg:last-child {
			display: inline;
		}
		.ql-bubble .ql-direction.ql-active svg:first-child {
			display: none;
		}
		.ql-bubble .ql-editor h1 {
			font-size: 2em;
		}
		.ql-bubble .ql-editor h2 {
			font-size: 1.5em;
		}
		.ql-bubble .ql-editor h3 {
			font-size: 1.17em;
		}
		.ql-bubble .ql-editor h4 {
			font-size: 1em;
		}
		.ql-bubble .ql-editor h5 {
			font-size: 0.83em;
		}
		.ql-bubble .ql-editor h6 {
			font-size: 0.67em;
		}
		.ql-bubble .ql-editor a {
			text-decoration: underline;
		}
		.ql-bubble .ql-editor blockquote {
			border-left: 4px solid #ccc;
			margin-bottom: 5px;
			margin-top: 5px;
			padding-left: 16px;
		}
		.ql-bubble .ql-editor code,
		.ql-bubble .ql-editor pre {
			background-color: #f0f0f0;
			border-radius: 3px;
		}
		.ql-bubble .ql-editor pre {
			white-space: pre-wrap;
			margin-bottom: 5px;
			margin-top: 5px;
			padding: 5px 10px;
		}
		.ql-bubble .ql-editor code {
			font-size: 85%;
			padding: 2px 4px;
		}
		.ql-bubble .ql-editor pre.ql-syntax {
			background-color: #23241f;
			color: #f8f8f2;
			overflow: visible;
		}
		.ql-bubble .ql-editor img {
			max-width: 100%;
		}
		.ql-bubble .ql-picker {
			color: #ccc;
			display: inline-block;
			float: left;
			font-size: 14px;
			font-weight: 500;
			height: 24px;
			position: relative;
			vertical-align: middle;
		}
		.ql-bubble .ql-picker-label {
			cursor: pointer;
			display: inline-block;
			height: 100%;
			padding-left: 8px;
			padding-right: 2px;
			position: relative;
			width: 100%;
		}
		.ql-bubble .ql-picker-label::before {
			display: inline-block;
			line-height: 22px;
		}
		.ql-bubble .ql-picker-options {
			background-color: #444;
			display: none;
			min-width: 100%;
			padding: 4px 8px;
			position: absolute;
			white-space: nowrap;
		}
		.ql-bubble .ql-picker-options .ql-picker-item {
			cursor: pointer;
			display: block;
			padding-bottom: 5px;
			padding-top: 5px;
		}
		.ql-bubble .ql-picker.ql-expanded .ql-picker-label {
			color: #777;
			z-index: 2;
		}
		.ql-bubble .ql-picker.ql-expanded .ql-picker-label .ql-fill {
			fill: #777;
		}
		.ql-bubble .ql-picker.ql-expanded .ql-picker-label .ql-stroke {
			stroke: #777;
		}
		.ql-bubble .ql-picker.ql-expanded .ql-picker-options {
			display: block;
			margin-top: -1px;
			top: 100%;
			z-index: 1;
		}
		.ql-bubble .ql-color-picker,
		.ql-bubble .ql-icon-picker {
			width: 28px;
		}
		.ql-bubble .ql-color-picker .ql-picker-label,
		.ql-bubble .ql-icon-picker .ql-picker-label {
			padding: 2px 4px;
		}
		.ql-bubble .ql-color-picker .ql-picker-label svg,
		.ql-bubble .ql-icon-picker .ql-picker-label svg {
			right: 4px;
		}
		.ql-bubble .ql-icon-picker .ql-picker-options {
			padding: 4px 0px;
		}
		.ql-bubble .ql-icon-picker .ql-picker-item {
			height: 24px;
			width: 24px;
			padding: 2px 4px;
		}
		.ql-bubble .ql-color-picker .ql-picker-options {
			padding: 3px 5px;
			width: 152px;
		}
		.ql-bubble .ql-color-picker .ql-picker-item {
			border: 1px solid transparent;
			float: left;
			height: 16px;
			margin: 2px;
			padding: 0px;
			width: 16px;
		}
		.ql-bubble .ql-picker:not(.ql-color-picker):not(.ql-icon-picker) svg {
			position: absolute;
			margin-top: -9px;
			right: 0;
			top: 50%;
			width: 18px;
		}
		.ql-bubble .ql-tooltip {
			background-color: #444;
			border-radius: 25px;
			color: #fff;
		}
		.ql-bubble .ql-tooltip-arrow {
			border-left: 6px solid transparent;
			border-right: 6px solid transparent;
			content: " ";
			display: block;
			left: 50%;
			margin-left: -6px;
			position: absolute;
		}
		.ql-bubble .ql-tooltip:not(.ql-flip) .ql-tooltip-arrow {
			border-bottom: 6px solid #444;
			top: -6px;
		}
		.ql-bubble .ql-tooltip.ql-flip .ql-tooltip-arrow {
			border-top: 6px solid #444;
			bottom: -6px;
		}
		.ql-bubble .ql-tooltip.ql-editing .ql-tooltip-editor {
			display: block;
		}
		.ql-bubble .ql-tooltip.ql-editing .ql-formats {
			visibility: hidden;
		}
		.ql-bubble .ql-tooltip-editor {
			display: none;
		}
	</style>
</head>
<body style="background-color: #f0f1f5;">
	<div class="main-table">
		<table cellpadding="0" cellspacing="0" style="font-family: 'Open Sans', sans-serif; margin:auto; width:600px; background-color:#fff; box-shadow:0px 0px 1px #aaa;">
			<tr>
				<td style="background-color:#990000; height:3px"></td>
			</tr>
			<tr>
				<td>
					<table style="width:100%; background-color:rgba(0, 0, 0,0.05);" cellspacing="0" cellpadding="0">
						<tr>
							<td style="height:20px;"></td>
						</tr>
						<tr>
							<td align="center">
								<a href=""><img src="https://cdn.shopify.com/s/files/1/0072/8547/3341/files/lumberjaxe-logo_300x300.png" style="display:inline-block;width: 120px;" /></a>
							</td>
						</tr>
						<tr>
							<td style="height:20px;"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="height:30px;"></td>
			</tr>
			<tr>
				<td style="font-size:16px; font-family:Arial, Helvetica, sans-serif; margin:0; color:#545251; line-height:26px;">
					<table style="width:100%; background-color:#fff;" cellspacing="0" cellpadding="0">
						<tr>
							<td style="width: 40px"></td>
							<td>
								{!! $body !!}
							</td>
							<td style="width: 40px"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="height:30px;"></td>
			</tr>
			<tr>
				<td>
					<table style="width:100%; background-color:#fff;" cellspacing="0" cellpadding="0">
						<tr>
							<td style="width: 40px"></td>
							<td>
								<p><b>Best Regards,</b></p>
							</td>
							<td style="width: 40px"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table style="width:100%; background-color:#fff;" cellspacing="0" cellpadding="0">
						<tr>
							<td style="width: 40px"></td>
							<td>
								<p>Lumberjaxe Administration Team</p>
							</td>
							<td style="width: 40px"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="background-color:#990000; height:3px"></td>
			</tr>

		</table>
	</div>
</body>
</html>