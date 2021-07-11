// authentication start
let login= require('./components/auth/login.vue').default;
let register= require('./components/auth/register.vue').default;
 let forgot= require('./components/auth/forgot.vue').default;
 let logout= require('./components/auth/logout.vue').default;
 let home= require('./components/home.vue').default;
 //authentication 
 
//employee components starts
let addEmployee= require('./components/employee/create.vue').default;
let AllEmployee= require('./components/employee/index.vue').default;
let editEmployee= require('./components/employee/edit.vue').default;
//employee components end

//supplier components start
let addSupplier= require('./components/supplier/create.vue').default;
let allSupplier= require('./components/supplier/index.vue').default;
let editSupplier= require('./components/supplier/edit.vue').default;
//supplier components end

//category components start
let addCategory= require('./components/category/create.vue').default;
let allCategory= require('./components/category/index.vue').default;
let editCategory= require('./components/category/edit.vue').default;
//category components end

//product components start
let addproduct= require('./components/product/create.vue').default;
let allproduct= require('./components/product/index.vue').default;
let editproduct= require('./components/product/edit.vue').default;
//product components end

//expense components start
let addexpense= require('./components/expense/create.vue').default;
let allexpense= require('./components/expense/index.vue').default;
let editexpense= require('./components/expense/edit.vue').default;
//expense components end

//customer components start
let addcustomer= require('./components/customer/create.vue').default;
let allcustomer= require('./components/customer/index.vue').default;
let editcustomer= require('./components/customer/edit.vue').default;
//customer components end

//salary components start
let salary= require('./components/salary/all_employee.vue').default;
let paysalary= require('./components/salary/create.vue').default;
let allsalary= require('./components/salary/index.vue').default;
let viewsalary= require('./components/salary/view.vue').default;
let editsalary= require('./components/salary/edit.vue').default;
//salary components end

//stock components start
let stock= require('./components/product/stock.vue').default;
let editstock= require('./components/product/stock-edit.vue').default;
//stock components end

//pos components start
let pos= require('./components/pos/pointofsell.vue').default;

//pos components end

//order components start
let order= require('./components/orders/order.vue').default;
let vieworder= require('./components/orders/vieworder.vue').default;
let search= require('./components/orders/search.vue').default;

//order components end


 //route path start
export const routes = [
  { path: '/', component: login, name:'/' },
  { path: '/register', component: register, name:'register' },
   { path: '/forgot', component: forgot, name:'forgot' },
   { path: '/logout', component: logout, name:'logout' },
   { path: '/home', component: home, name:'home' },

   //employee routes
   { path: '/store-employee', component: addEmployee, name:'store-employee' },
   { path: '/employee', component: AllEmployee, name:'employee' },
   { path: '/edit-employee/:id', component: editEmployee, name:'edit-employee' },

   //supplier routes
   { path: '/store-supplier', component: addSupplier, name:'store-supplier' },
   { path: '/supplier', component: allSupplier, name:'supplier' },
   { path: '/edit-supplier/:id', component: editSupplier, name:'edit-supplier' },

      //supplier routes
   { path: '/store-category', component: addCategory, name:'store-category' },
   { path: '/category', component: allCategory, name:'category' },
   { path: '/edit-category/:id', component: editCategory, name:'edit-category' },

     //product routes
   { path: '/store-product', component: addproduct, name:'store-product' },
   { path: '/product', component: allproduct, name:'product' },
   { path: '/edit-product/:id', component: editproduct, name:'edit-product' },

     //Expense routes
   { path: '/store-expense', component: addexpense, name:'store-expense' },
   { path: '/expense', component: allexpense, name:'expense' },
   { path: '/edit-expense/:id', component: editexpense, name:'edit-expense' },

       //salary routes
   { path: '/given-salary', component: salary, name:'given-salary' },
   { path: '/pay-salary/:id', component: paysalary, name:'pay-salary' },
   { path: '/salary', component: allsalary, name:'salary' },
   { path: '/view-salary/:id', component: viewsalary, name:'view-salary' },
   { path: '/edit-salary/:id', component: editsalary, name:'edit-salary' },

  //stock routes
  { path: '/stock', component: stock, name:'stock' },
  { path: '/edit-stock/:id', component: editstock, name:'edit-stock' },

  //customer routes
   { path: '/store-customer', component: addcustomer, name:'store-customer' },
   { path: '/customer', component: allcustomer, name:'customer' },
   { path: '/edit-customer/:id', component: editcustomer, name:'edit-customer' },

   //pos routes
    { path: '/pos', component: pos, name:'pos' },

    //order routes
  { path: '/order', component: order, name:'order' },
  { path: '/view-order/:id', component: vieworder, name:'view-order' },
  { path: '/search', component: search, name:'search' }

]
//route path end