<template>
 <div>
			<div class="page-content">

				<h6 class="mb-0 text-uppercase"><b>Todays Order</b></h6>
					
				<hr/>
				<div class="card">
					<div class="card-body">
						<input type="text" v-model="searchTerm" class="form-control mb-3 search" placeholder="Search Here" style="width:175px; height:40px;">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Name</th>
										<th>Total Amount</th>
										<th>Pay</th>
										<th>Due</th>
										<th>PayBy</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="order in filterSearch" :key="order.id">
										<td>{{ order.name }}</td>
										<td>{{ order.total }}$</td>
										<td>{{ order.pay }}$</td>
										<td>{{ order.due }}$</td>
										<td>{{ order.payby }}</td>																			
										<td>
										<router-link :to="{name:'view-order',params:{id:order.id}}" class="btn btn-sm btn-success">View</router-link>
										
										</td>
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
			orders:[],
			searchTerm:''
		}
	},
	computed:{
		filterSearch(){
			return this.orders.filter(order=>{
				return order.name.match(this.searchTerm)
			})
		}
	},
	methods: {
		allOrder(){
			axios.get('/api/orders')
			 .then(({data})=>(this.orders=data))		
			.catch()
		},
	

	},
	created(){

    	this.allOrder();

       }
}
</script>

<style>
    
    #img{
        height: 40px;
		width: 40px;
    }
	.search{
		float: right;
	}
</style>