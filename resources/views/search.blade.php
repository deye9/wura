@extends('layouts.wura')
@section('page_heading','Search Results')

@section('styles')
    <style>
		*, *:before, *:after {
			-webkit-box-sizing: border-box; 
			-moz-box-sizing: border-box; 
			box-sizing: border-box;
		}

		#integration-list {
			width: 100%;
			margin: 0 auto;
			/* display: table; */
		}

		#integration-list ul {
			color: #fff;
			padding: 0;
			margin: 20px 0;
		}

		#integration-list ul > li:hover {
			color: white;
			background-color: #000;
		}

		.listStyle {
			padding: 0px;
			display: block;
			overflow: scroll;
			list-style: none;
			border-top: 1px solid #ddd;
		}

		#integration-list ul:last-child {
			border-bottom: 1px solid #ddd;
		}

		.expand {
			display: block;
			text-decoration: none;
			color: #555;
			cursor: pointer;
		}

		.detail {
			margin: 10px 0 10px 0px;
			display: none;
			line-height: 22px;
			height: 150px;
			overflow: scroll;
		}

		.right-arrow {
			margin-top: 12px;
			margin-left: 20px;
			width: 10px;
			height: 100%;
			float: right;
			font-weight: bold;
			font-size: 20px;
		}

		span {
			font-size: 12.5px;
		}

		.detail span{
			margin: 0;
		}
    </style>
@stop

@section('content')
    <hgroup class="mb20">
		<h2 class="lead">
			<strong class="standout">{{ sizeof($searchResults) }}</strong> 
			results were found for 
			<strong class="standout">
				{{ $searchText }}
			</strong>
			under {{ round($executionTime, 3) }} seconds
		</h2>								
	</hgroup>

	<div id="integration-list">
		<ul>
			@foreach ($searchResults as $searchresult)
				<?php
					$classname = ''; $url = ''; $fields = array(); $cnt = 0; $url = '#';
					$result = json_decode($searchresult->results, true);
					$length = count($result);

					switch (strtolower($searchresult->tablename)) {
						case 'calendars':
							$classname = 'fa fa-calendar fa-fw';
							$fields = array("title", "start", "end");
							break;
							
						case 'cards':
							$classname = 'fa fa-credit-card fa-fw';
							$fields = array("cardnos", "valid_until", "status");
							break;
				
						case 'notifications':
							$classname = 'fa fa-bell-o fa-fw';
							$fields = array("type", "recipient", "subject");
							break;
			
						case 'transactions':
							$classname = 'fa fa-exchange-alt fa-fw';
							$fields = array("cardnos", "amount", "merchant");
							break;
		
						case 'users':
							$classname = 'fa fa-users fa-fw';
							$fields = array("firstname", "lastname", "email");
							break;
	
						case 'vehicle_docs':
							$classname = 'fa fa-file-image-o fa-fw';
							$fields = array("doctypes", "expirydate", "status");
							break;

						case 'vehicles':
							$classname = 'fa fa-car fa-fw';
							$fields = array("owner_name", "license_plate_number", "make", 'model', 'year', 'trim', 'purchase_date');
							break;
	
						case 'wallets':
							$classname = 'fa fa-google-wallet fa-fw';
							$fields = array("walletname", "amount", 'status');
							break;
							
						case 'drivers':
							$classname = 'fa fa-id-badge fa-fw';
							$fields = array("firstname", "middlename", 'lastname', 'mobilenumber', 'email', 'status');
							break;
					}
				?>
				<li class="listStyle">
					<a class="expand">
						<div class="right-arrow">+</div>
						<div style="text-align: left; padding-left:20px;">
							<h2 style="color: #01c0c8;">
								<i class="{{ $classname }}"></i>
								{{ ucwords(str_replace('vehicle_docs', 'Vehicle Documents', $searchresult->tablename)) }}
							</h2>
							<span> 
								{{ $length }} {{ ($length > 1 ? 'records' : 'record') }} found for 
								<strong style="color: #01c0c8;"> {{ $searchText }} </strong> under 
								<strong style="color: #01c0c8;"> {{ ucwords(str_replace('_', ' ', $searchresult->columnname)) }} </strong>
							</span>
						</div>
					</a>

					<div class="detail">
						<div class="table-responsive">
							<table class="table dtable table-hover table-condensed table-bordered">
							<thead>
								<tr>
									<th> # </th>
									<?php
										foreach ($fields as &$field) {
											echo '<th> ' . ucwords(str_replace('_', ' ', $field)) . ' </th>';
										}
									?>
									<th> Action </th>
								</tr>
							</thead>
							<tbody>
								<?php
									for ($i = 0; $i < $length; $i++) {
										$cnt++;
										echo '<tr>';
										echo '<td>' . $cnt . '</td>';
										foreach ($fields as &$field) {
											echo '<td>' . $result[$i][$field] . '</td>';
										}
										echo '<td><a href="/preview/' . $searchresult->tablename . '/' . $result[$i]['id'] . '" class="btn btn-primary">More Details...</a></td>';
										echo '</tr>';
									}
								?>
							</tbody>
							</table>
						</div>
					</div>
				</li>
			@endforeach
		</ul>
	</div>
@endsection