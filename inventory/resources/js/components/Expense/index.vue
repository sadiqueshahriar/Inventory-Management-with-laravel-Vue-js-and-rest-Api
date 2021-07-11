<template>
 <div>
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center">
					<div class="ms-auto">
						<div class="btn-group">
							 <router-link to="/store-expense" class="btn btn-primary">Add Expense</router-link>
							 
						</div>

					</div>
				</div>
				<!--end breadcrumb-->
				<h6 class="mb-0 text-uppercase"><b>All Expense List</b></h6>
					
				<hr/>
				<div class="card">
					<div class="card-body">
						<input type="text" v-model="searchTerm" class="form-control mb-3 search" placeholder="Search Here" style="width:175px; height:40px;">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>Expense Details</th>
										<th>Amount</th>
										<th>Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="expense in filterSearch" :key="expense.id">
										<td>{{ expense.details }}</td>
										<td>{{ expense.amount }}</td>
										<td>{{ expense. expense_date  }}</td>
																			
										<td>
										<router-link :to="{name:'edit-expense',params:{id:expense.id}}" class="btn btn-sm btn-primary">Edit</router-link>
										<a @click="expenseDelete(expense.id)" class="btn btn-sm btn-danger">Delete</a>	
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
			expenses:[],
			searchTerm:''
		}
	},
	computed:{
		filterSearch(){
			return this.expenses.filter(expense=>{
				return expense.expense_date.match(this.searchTerm)
			})
		}
	},
	methods: {
		allExpense(){
			axios.get('/api/expense')
			 .then(({data})=>(this.expenses=data))		
			.catch()
		},
		expenseDelete(id){

			Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
			if (result.value) {
				axios.delete('/api/expense/'+id)
				.then(()=>{
					this.expenses=this.expenses.filter(expense=>{
						return expense.id != id
					})
				})
				.catch(error=>this.errors=error.response.data.errors)		
				Swal.fire(
				'Deleted!',
				'Your file has been deleted.',
				'success'
				)
			  }
			})
				

		}

	},
	created(){

    	this.allExpense()

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