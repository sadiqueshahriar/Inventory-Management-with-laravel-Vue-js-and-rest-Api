<template>
 <div>
	
    
   			<div class="row">
					<div class="col-xl-10 mx-auto">
						<div class="card border-top border-0 border-4 border-primary">
							<div class="card-body p-5">
								<div class="card-title d-flex align-items-center">
									<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
									</div>
									<h5 class="mb-0 text-primary">Search Order</h5>
								</div>
								<hr>
								<form class="row g-3" @submit.prevent="save">
									<div class="col-12">
										<label for="inputcategoryname" class="form-label">Search By Date</label>
										<input type="date" class="form-control" id="inputdate" v-model="date">
								
									</div>

									<div class="col-12">
										<button type="submit" class="btn btn-primary px-5" >Search</button>
									</div>
								</form>
							</div>
						</div>
                    <div class="card-header">
						<h5 class="text-primary text-center">Order Details Table</h5>
					</div>
                    							<div class="card-body">
                             <div class="table-responsive">
						   <table class="table align-middle mb-0">
							<thead class="table-light">
							 <tr>
							   <th>Customer Name</th>						   
							   <th>Qty</th>
							   <th>Vat</th>
							   <th>Total</th>
							   <th>Pay</th>
							   <th>Due</th>
							 </tr>
							 </thead>
							 <tbody>
							<tr v-for="order in orders" :key="order.id">
							  <td>{{ order.name }}</td>
							  <td>{{ order.qty}}</td>							 				
							  <td>{{ order.vat}}%</td>					
							  <td>{{ order.total}}$</td>					
							  <td>{{ order.pay }}$</td>					
							  <td>{{ order.due }}$</td>					
							</tr>
		  




						    </tbody>
						  </table>
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
			
				date:'',
				orders:{}
			
	
		}
		

	},
	
	methods: {
        save(){
			var data={date:this.date}			
		    axios.post('/api/search/order/',data)
            .then(({data})=>(this.orders=data))
			.catch(error=>this.errors=error.response.data.errors)

        }
		
	}

    
}
</script>

<style>
    
    .button{
        margin-right: 90px;
        margin-top: 26px;
    }
</style>