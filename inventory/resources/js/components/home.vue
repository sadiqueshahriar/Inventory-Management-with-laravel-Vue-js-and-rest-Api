<template>
<div>
    			<div class="page-content">
				<div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 row-cols-xxl-4">
                   <div class="col">
					 <div class="card radius-10 bg-gradient-cosmic">
						<div class="card-body">
							<div class="d-flex align-items-center">
								<div class="me-auto">
									<p class="mb-0 text-white">Todays Sell Amount</p>
									<h4 class="my-1 text-white">${{todaysell}}</h4>
									<p class="mb-0 font-13 text-white">+2.5% from last week</p>
								</div>
								<div id="chart1"></div>
							</div>
						</div>
					 </div>
				   </div>
				   <div class="col">
					<div class="card radius-10 bg-gradient-ibiza">
					   <div class="card-body">
						   <div class="d-flex align-items-center">
							   <div class="me-auto">
								   <p class="mb-0 text-white">Todays Revenue</p>
								   <h4 class="my-1 text-white">${{ income }}</h4>
								   <p class="mb-0 font-13 text-white">+5.4% from last week</p>
							   </div>
							   <div id="chart2"></div>
						   </div>
					   </div>
					</div>
				  </div>
				  <div class="col">
					<div class="card radius-10 bg-gradient-ohhappiness">
					   <div class="card-body">
						   <div class="d-flex align-items-center">
							   <div class="me-auto">
								   <p class="mb-0 text-white">Due Today</p>
								   <h4 class="my-1 text-white">${{ due }}</h4>
								   <p class="mb-0 font-13 text-white">-4.5% from last week</p>
							   </div>
							   <div id="chart3"></div>
						   </div>
					   </div>
					</div>
				  </div>
				  <div class="col">
					<div class="card radius-10 bg-gradient-kyoto">
					   <div class="card-body">
						   <div class="d-flex align-items-center">
							   <div class="me-auto">
								   <p class="mb-0 text-dark">Expense Today</p>
								   <h4 class="my-1 text-dark">{{expense}}</h4>
								   <p class="mb-0 font-13 text-dark">+5.4% from last week</p>
							   </div>
							   <div id="chart4"></div>
						   </div>
					   </div>
					</div>
				  </div> 
				</div><!--end row-->
				<div class="card">
					<div class="card-header">
						<h5 class="text-primary">Out of Stock</h5>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Name</th>
										<th>Code</th>
										<th>Photo</th>
										<th>Buying Price</th>
										<th>Status</th>
										<th>Quantity</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="product in products" :key="product.id">
										<td>{{ product.product_name }}</td>
										<td>{{ product.product_code }}</td>
										<td><img :src="product.image" id="img" ></td>
										<td>{{ product.buying_price }}</td>
                            <td v-if="product.product_quantity>=1"><span class="badge badge-success">Available</span>                             
                            </td>
                            <td v-else><span class="badge badge-danger">Stock Out</span>                             
                            </td>

										<td>{{ product.product_quantity }}</td>
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
export default{
	created(){
		if(!User.loggedIn()){
			this.$router.push({name:'/'})

		}

	},
	mounted() {
		this.todaySell();
		this.todayincome();
		this.todaydue();
		this.todayexpense();
		this.stockOut();
	},
	data(){
		return {
			todaysell:'',
			income:'',
			due:'',
			expense:'',
			products:''
		}
	},
	methods: {
		todaySell(){
			axios.get('/api/today/sell/')
            .then(({data})=>(this.todaysell=data))
			.catch(error=>this.errors=error.response.data.errors)

		},
		todayincome(){
		axios.get('/api/today/income/')
		.then(({data})=>(this.income=data))
		.catch(error=>this.errors=error.response.data.errors)

		},
		todaydue(){
		axios.get('/api/today/due/')
		.then(({data})=>(this.due=data))
		.catch(error=>this.errors=error.response.data.errors)

		},
		todayexpense(){
		axios.get('/api/today/expense/')
		.then(({data})=>(this.expense=data))
		.catch(error=>this.errors=error.response.data.errors)

		},
		stockOut(){
		axios.get('/api/today/stockout/')
		.then(({data})=>(this.products=data))
		.catch(error=>this.errors=error.response.data.errors)

		},
		
	},
}

</script>

<style>
    
</style>
