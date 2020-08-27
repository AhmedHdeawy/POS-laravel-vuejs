<template>
  <div class="container">
    <Search @search-products="searchProducts"></Search>
    <div class="row">
      <div class="mb-3">
        <button class="btn btn-success btn-lg" @click="newProductModal">اضافة صنف جديد</button>
        <product-form
          @new-product="addNewProduct"
          @update-product="UpdateProduct"
          :productData.sync="productData"
        ></product-form>
      </div>
      <div v-if="!loader.load" class="card w-100">
        <div class="card-header">
          <h4>الاصناف</h4>
        </div>
        <div class="card-body">
          <table v-if="products.length > 0" class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">اسم الصنف</th>
                <th scope="col">السعر</th>
                <th scope="col">الكميه</th>
                <th scope="col">الاجراء</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="product in products" :key="product.id">
                <th scope="row">{{ product.id }}</th>
                <td>{{ product.name }}</td>
                <td>{{ product.price }}</td>
                <td>{{ product.quantity }}</td>
                <td>
                  <button class="btn btn-info" @click="editProduct(product)">تعديل الصنف</button>
                </td>
              </tr>
            </tbody>
          </table>
          <div v-else class="text-center">
            <h3 class="text-danger">لايوجد اصناف</h3>
          </div>
        </div>
      </div>
      <div v-else class="col-12 justify-content-center d-flex my-5">
        <bounce-loader class="custom-class" :color="loader.color" :size="loader.size"></bounce-loader>
      </div>
    </div>
  </div>
</template>

<script>
import { BounceLoader } from "@saeris/vue-spinners";
import ProductForm from "./ProductForm";
import Search from "./search";
export default {
  components: {
    BounceLoader,
    ProductForm,
    Search
  },
  data() {
    return {
      products: [],
      productData: {
        id: null,
        name: "",
        price: 1,
        quantity: 1
      },
      loader: {
        load: false,
        size: 100,
        color: "#3490dc"
      }
    };
  },
  mounted() {
    this.loadProducts();
  },
  methods: {
    loadProducts() {
      // Run Loader
      this.loader.load = true;
      axios.get("/admin/loadProducts").then(data => {
        let loadedProducts = (this.allProducts = data.data);

        // Loop through products from server
        loadedProducts.forEach(product => {
          this.products.push(product);

          // Stop Loader
          this.loader.load = false;
        });
      });
    },
    // Open Modal to Add new Product
    newProductModal() {
      this.resetProductData();
      $("#ProductForm").modal("show");
    },

    // Add New Product
    addNewProduct(product) {
        console.log("New");
      this.products.unshift(product);
    },

    editProduct(product) {
      this.productData = _.clone(product);
      $("#ProductForm").modal("show");
    },

    // Update exist products with new products from DB
    UpdateProduct(product) {
        console.log("Update");

        // Update Product in products array based on it's Index
        this.$set(this.products, _.findIndex(this.products, ['id', product.id]), product)
    },
    // Search in Products
    searchProducts(products) {
      this.products = products;
    },
    resetProductData() {
      this.productData.id = null;
      this.productData.name = "";
      this.productData.price = this.productData.quantity = 1;
    }
  }
};
</script>

<style>
</style>
