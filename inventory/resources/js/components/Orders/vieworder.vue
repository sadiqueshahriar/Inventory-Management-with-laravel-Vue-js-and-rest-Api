<template>
    <div>                

    			<div class="row">
                       
					<div class="col-xl-6 mx-auto">
						
						<hr/>
						<div class="card border-top border-0 border-4 border-primary">
						<div class="card-header">
						<h5 class="text-primary">Order Details</h5>
							</div>
							<div class="card-body">
								<ul class="list-group">
								<li class="list-group-item"><b>Name:</b> {{orders.name}}</li>
								<li class="list-group-item"><b>Phone:</b>{{orders.phone}}</li>
								<li class="list-group-item"><b>Address:</b> {{orders.address}}</li>
								<li class="list-group-item"><b>Date:</b> {{orders.order_date}}</li>
								<li class="list-group-item"><b>Pay Through:</b> {{orders.payby}}</li>
								</ul>
    
							</div>
						</div>						
					</div>

                	<div class="col-xl-6 mx-auto">
						
						<hr/>
						<div class="card border-top border-0 border-4 border-primary">
						<div class="card-header">
						<h5 class="text-primary">Order Details</h5>
							</div>
							<div class="card-body">
								<ul class="list-group">
								<li class="list-group-item"><b>Quantity:</b> {{orders.qty}}</li>
								<li class="list-group-item"><b>Vat:</b>{{orders.vat}}%</li>
								<li class="list-group-item"><b>Total:</b> {{orders.total}}$</li>
								<li class="list-group-item"><b>Pay:</b> {{orders.pay}}$</li>
								<li class="list-group-item"><b>Due:</b> {{orders.due}}$</li>
								</ul>
						

							</div>
						</div>						
					</div>

                     
					<div class="col-xl-12 mx-auto">
						
						<hr/>
						<div class="card border-top border-0 border-4 border-primary">
						<div class="card-header">
						<h5 class="text-primary text-center">Order Details Table</h5>
							</div>
							<div class="card-body">
                             <div class="table-responsive">
						   <table class="table align-middle mb-0">
							<thead class="table-light">
							 <tr>
							   <th>Product Name</th>
							   <th>Product Code</th>
							   <th>Photo</th>						   
							   <th>Qty</th>
							   <th>Unit Price</th>
							   <th>Sub Total</th>
							 </tr>
							 </thead>
							 <tbody>
							<tr v-for="detail in details" :key="detail.id">
							  <td>{{ detail.product_name }}</td>
							  <td>{{ detail.product_code }}</td>
							 <td><img :src="'/'+detail.image" id="img" ></td>
							  <td>{{ detail.pro_quantity }}</td>					
							  <td>{{ detail.product_price }}$</td>					
							  <td>{{ detail.sub_total }}$</td>					
							</tr>
		  




						    </tbody>
						  </table>
						  </div>
						

							</div>
						</div>						
					</div>

				</div>

    </div>
</template>
<script>

export default {
    created(){
		if(!User.loggedIn()){
			this.$router.push({name:'/'})
		}
	},
	data(){
		
		return{
            orders:{},
            details:{}
	
		}
		

	},
    created(){
        let id=this.$route.params.id
        axios.get('/api/order/details/'+id)
        .then(({data})=>(this.orders=data))
        .catch(console.log('error'))     
       
        axios.get('/api/order/orderdetails/'+id)
        .then(({data})=>(this.details=data))
        .catch(console.log('error'))

   
    },	
	methods: {
        
		
	}

    
}
</script>

<style>
    
    .button{
    margin-right: 90px;
    margin-top: 26px;
    }
  #img{
        height: 40px;
		width: 40px;
    }
</style>