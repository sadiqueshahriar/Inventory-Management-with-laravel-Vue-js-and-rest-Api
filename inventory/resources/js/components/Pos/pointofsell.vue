<template>

 <div>
     			<div class="row mx-2">
                    <h2 class="m-3">POS Dashboard</h2>
					<div class="col-12 col-lg-5">
						<div class="card radius-10">
							<div class="card-header py-2 d-flex flex-row align-items-center justify-content-between">
							<h6 class="m-0">Expense Insert</h6>	
							<router-link to="/store-customer" class="btn btn-sm btn-info "> <font color="#fffffff"> Add Customer</font></router-link>
							</div>
							<div class="card-body">
							 <div class="d-flex align-items-center">
					<div class="table-responsive" style="font-size:12px;">
						   <table class="table align-middle mb-0">
							<thead class="table-light">
							 <tr>
							   <th>Name</th>
							   <th>Qtn</th>
							   <th>Unit</th>
							   <th>Total</th>
							   <th>Action</th>
							 </tr>
							 </thead>
							 <tbody>
							<tr v-for="cart in carts" :key="cart.id">
							  <td>{{ cart.pro_name }}</td>
							  <td><input type="text" readonly="" style="width:20px; height:20px;" :value="cart.pro_quantity">
							  <button class="btn btn-sm btn-success" @click.prevent="
							  increment(cart.id)">+</button>
							  <button class="btn btn-sm btn-danger" @click.prevent="
							  decrement(cart.id)" v-if="cart.pro_quantity>=2">-</button>
							  <button class="btn btn-sm btn-danger" v-else disabled>-</button>
							  </td>
							  
						
							  <td>{{ cart.pro_price }}</td>
							  <td>{{ cart.pro_subtotal }}</td>
							 
							  <td><a @click="removeItems(cart.id)" class="btn btn-sm btn-primary">X</a></td>
							 </tr>

	
		  		  		  		  
						    </tbody>
						  </table>
						  </div>

							 </div>
							
							</div>
							<div class="card-footer">
							<ul class="list-group">
		    <li class="list-group-item d-flex justify-content-between align-items-center">
				Total Quantity: <strong>{{ qty }}</strong>
			</li>	
		    <li class="list-group-item d-flex justify-content-between align-items-center">
				Sub Total: <strong>{{subtotal}}$</strong>
			</li>
		    <li class="list-group-item d-flex justify-content-between align-items-center">
				VAT: <strong>{{ vats.vat }}%</strong>
			</li>	
		    <li class="list-group-item d-flex justify-content-between align-items-center">
				Total: <strong>{{subtotal*vats.vat/100 +subtotal}}$</strong>
			</li>																			
							</ul><br>
							<form @submit.prevent="orderdone">
								<label for="Customername">Customer Name</label>
								<select class="form-control" v-model="customer_id">
									<option :value="customer.id" v-for="customer in customers" :key="customer.id">{{ customer.name }}</option>
									
								</select>
								<label>Pay</label>
								<input type="text" class="form-control" required="" v-model="pay">
								<label>Due</label>
								<input type="text" class="form-control" required="" v-model="due">
								<label for="Customername">Pay By </label>
								<select class="form-control" v-model="payby">
									<option value="Cash">Cash</option>
									<option value="Cheaque">Cheaque</option>
									<option value="Gift Card">Gift Card</option>
								</select>
								<br>
								<button class="btn btn-success">Submit</button>								
							</form>
							</div>
						</div>
					</div>
					<div class="col-12 col-lg-7"> 
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All product</a>
  </li>

  <li class="nav-item" v-for="category in categories" :key="category.id">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" @click="subProduct(category.id)">{{ category.category_name}}</a>
  </li>

</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      					<div class="card radius-10">
 						<input type="text" v-model="searchTerm" class="form-control mb-3 search" placeholder="Search Product" style="width:658px; height:40px; margin-left:15px;"> 
                                                
						<div class="card-body">
                          <div class="row"> 
							 <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filterSearch" :key="product.id">
							 <button class="btn btn-sm" @click.prevent="AddToCart(product.id)">                               
                                     <div class="card" style="width: 8.5rem;">
                                        <img class="card-img-top" :src="product.image" id="img">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ product.product_name }}</h5>
                             <span class="badge badge-success" v-if="product.product_quantity>=1">Available {{ product.product_quantity }}</span>                          
                            
                            <span class="badge badge-danger" v-else>Stock Out</span>                             
                                                                     
                                          
                                       </div>
                                     </div>
									 </button>
                                 </div>
                             </div>

							</div>
                            
						</div>
      
    </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      				<div class="card radius-10">
 						<input type="text" v-model="searchTerm" class="form-control mb-3 search" placeholder="Search Product" style="width:658px; height:40px; margin-left:15px;"> 
                                                
						<div class="card-body">
                          <div class="row"> 
							 <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="getproduct in getfilterSearch" :key="getproduct.id">
                        <button class="btn btn-sm" @click.prevent="AddToCart(getproduct.id)">       
                                     <div class="card" style="width: 8.5rem;">
                                        <img class="card-img-top" :src="getproduct.image" id="img">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ getproduct.product_name }}</h5>
                             <span class="badge badge-success" v-if="getproduct.product_quantity>=1">Available {{ getproduct.product_quantity }}</span>                          
                            
                            <span class="badge badge-danger" v-else>Stock Out</span>                             
                                                                     
                                          
                                         </div>
                                        </div>
						</button>
                                 </div>
                             </div>

							</div>
                            
						</div>
      
  </div>
 
</div>



					</div>
				</div><!--end row-->
 </div>
</template>
<script>
export default {
    created(){
		if(!User.loggedIn()){
			this.$router.push({name:'/'})
		}
	},
	created(){

    this.allProduct();
    this.allCategory();
    this.allCustomer();
    this.cartproduct();
    this.vat();
	Reload.$on('AfterAdd',()=>{
		this.cartproduct();
	})


       },
	data(){
		return{
			customer_id:"",
			pay:"",
			due:"",
			payby:"",
			products:[],
			categories:"",
			getproducts:[],
			customers:[],
			searchTerm:'',
			carts:[],
			vats:"",
		}
	},
	computed:{
		filterSearch(){
			return this.products.filter(product=>{
				return product.product_name.match(this.searchTerm)
			})
		},
        getfilterSearch(){
			return this.getproducts.filter(getproduct=>{
				return getproduct.product_name.match(this.searchTerm)
			})
		},

		qty(){
			let sum=0;
		for (let i = 0; i < this.carts.length; i++) {
			sum+=(parseFloat(this.carts[i].pro_quantity))			
		  }
		return sum;
	  },
	  subtotal(){
		  let sum=0;
		for (let i = 0; i < this.carts.length; i++) {
			sum+=(parseFloat(this.carts[i].pro_quantity) * parseFloat(this.carts[i].pro_price))			
		  }
		  return sum;
	  }

	},
	methods: {
		//add to card start
		AddToCart(id){
		axios.get('/api/addToCart/'+id)
			 .then(()=>{
				 Reload.$emit('AfterAdd');
				 Notification.cart_success()
			 })		
			.catch(error=>this.errors=error.response.data.errors)

		},
		cartproduct(){
			axios.get('/api/cart/product/')
			 .then(({data})=>(this.carts=data))		
			.catch(error=>this.errors=error.response.data.errors)
		},
		removeItems(id){
			axios.get('/api/remove/cart/'+id)
			 .then(()=>{
				 Reload.$emit('AfterAdd');
				 Notification.cart_delete()
			 })		
			.catch(error=>this.errors=error.response.data.errors)			
		},
		increment(id){
		axios.get('/api/increment/'+id)
			 .then(()=>{
				 Reload.$emit('AfterAdd');
			 })		
			.catch(error=>this.errors=error.response.data.errors)
		},
		decrement(id){
		axios.get('/api/decrement/'+id)
			 .then(()=>{
				 Reload.$emit('AfterAdd');
			 })		
			.catch(error=>this.errors=error.response.data.errors)
		},
		vat(){
			axios.get('/api/vats/')
			 .then(({data})=>(this.vats=data))		
			.catch(error=>this.errors=error.response.data.errors)
		},
		orderdone(){
			let total=this.subtotal*this.vats.vat/100 +this.subtotal;
			var data={qty:this.qty,subtotal:this.subtotal,customer_id:this.customer_id,pay:this.pay,due:this.due,payby:this.payby,vat:this.vats.vat,total:total}

			 axios.post('/api/orderdone/',data)
			.then(()=>{					 
             Notification.success()
			this.$router.push({name:'home'})
			})
			.catch(error=>this.errors=error.response.data.errors)

		},

		//add to card end
		allProduct(){
			axios.get('/api/product')
			 .then(({data})=>(this.products=data))		
			.catch(error=>this.errors=error.response.data.errors)
		},
		allCategory(){
			axios.get('/api/category')
			 .then(({data})=>(this.categories=data))		
			.catch(error=>this.errors=error.response.data.errors)
		},
		allCustomer(){
			axios.get('/api/customer')
			 .then(({data})=>(this.customers=data))		
			.catch(error=>this.errors=error.response.data.errors)
		},
		subProduct(id){
			axios.get('/api/getting/product/'+id)
			 .then(({data})=>(this.getproducts=data))		
			.catch(error=>this.errors=error.response.data.errors)
		}              
	

	}

}
</script>

<style scoped>
    
    #img{
        height: 100px;
		width: 130px;
    }
	.search{
		float: right;
	}
</style>