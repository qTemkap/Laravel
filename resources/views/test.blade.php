@extends('layouts.app')

@section('content')
<style type="text/css">

.div1 {    
    width: 50%;
    min-height: 150px;
    background: #ccc;
}

.all {
	width: 300px;
}

.all div {
	display: inline-block;
}

</style>
<input type="checkbox" onclick="$('.qwe').toggle();" name="">
<div class="all">
	<div class="div1">div1</div><div class="div1">div1</div><div class="div1 qwe">div21</div><div class="div1">div1</div><div class="div1">div1</div><div class="div1">div1</div><div class="div1">div1</div><div class="div1">div1</div><div class="div1">div1</div><div class="div1">div1</div><div class="div1">div1</div><div class="div1">div1</div><div class="div1">div1</div><div class="div1">div2</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="owl-carousel owl-theme mt-5">
			<div class="row m-2" data-hash="2">
				<div class="col-md-12">
					<div style="width: 210px;height: 200px;display: inline-block;">
						<div style="width:50%">sdgsdgsdg</div>
						<div style="width:50%;margin-left: 50%;">sdgsdgsdg</div>
						
							<!-- @foreach($arr as $key=>$us)						
								@if($key%2)
									<tr>
										<td>{{$us.$key}}</td>
								@else
										<td>{{$us.$key}}</td>
									</tr>
								@endif
							@endforeach -->
					</div>
		
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
</script>

@endsection

{foreach from=$retailers key=key item=retailer}
				{assign var="key" value=$key+1}
				{assign var="id" value=$retailer.intRetailerID}					
				{if $key%2}
					<tr>
						<td>
							<span id="ret_{$retailer.intRetailerID}" style="display:block;">
								<span>
									<input type="checkbox" name="arrGLNs[]" {if $retailer.selected}checked{/if} value="{$retailer.intRetailerID}">
								</span>
								<span class="ret" id="{$retailer.intRetailerID}">{$retailer.varName} ({$retailer.varGln})</span>
							</span>
						</td>
				{else}
						<td>
							<span id="ret_{$retailer.intRetailerID}" style="display:block;">
								<span>
									<input type="checkbox" name="arrGLNs[]" {if $retailer.selected}checked{/if} value="{$retailer.intRetailerID}">
								</span>
								<span class="ret" id="{$retailer.intRetailerID}">{$retailer.varName} ({$retailer.varGln})</span>
							</span>
						</td>
					</tr>
				{/if}
			{/foreach}