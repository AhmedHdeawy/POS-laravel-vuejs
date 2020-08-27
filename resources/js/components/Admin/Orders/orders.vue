<template>
  <div class="container">
    <!-- Search -->
    <Search @search-orders="searchOrders"></Search>

    <!-- Order Products -->
    <order-products :products="products" :price="price"></order-products>
    <div class="row">
      <div v-if="!loader.load" class="card w-100">
        <div class="card-header">
          <h4>الفواتير</h4>
        </div>
        <div class="card-body">
          <table v-if="orders.length > 0" class="table table-striped">
            <thead>
              <tr class="text-center">
                <th scope="col">التاريخ</th>
                <th scope="col">اسم العميل</th>
                <th scope="col">السعر</th>
                <th scope="col">الاصناف</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="order in orders" :key="order.id">
                <th>{{ formateDate(order.created_at) }}</th>
                <td>{{ order.client_name ? order.client_name : '--' }}</td>
                <td>{{ order.price }}</td>
                <td>
                  <button class="btn btn-primary" @click="showOrderProducts(order)">الاصناف</button>
                </td>
              </tr>
            </tbody>
          </table>
          <div v-else class="text-center">
            <h3 class="text-danger">لايوجد فواتير</h3>
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
import moment from "moment";
import { BounceLoader } from "@saeris/vue-spinners";
import Search from "./search";
import OrderProducts from "./OrderProducts";
export default {
  components: {
    BounceLoader,
    Search,
    OrderProducts
  },
  data() {
    return {
      orders: [],
      price: 0,
      products: [],
      loader: {
        load: false,
        size: 100,
        color: "#3490dc"
      }
    };
  },
  mounted() {
    this.loadOrders();
  },
  methods: {
    loadOrders() {
      // Run Loader
      this.loader.load = true;
      axios.get("/admin/loadOrders").then(data => {
        let loadedOrders = (this.allOrders = data.data);

        // Loop through orders from server
        loadedOrders.forEach(order => {
          this.orders.push(order);

          // Stop Loader
          this.loader.load = false;
        });
      });
    },

    searchOrders(orders) {
      this.orders = orders;
    },

    showOrderProducts(order) {
      this.products = order.items;
      this.price = order.price;
      $("#OrderProducts").modal("show");
    },

    formateDate(date) {
        return moment(date).format("DD-MM-YYYY")
    }
  }
};
</script>

<style>
</style>
