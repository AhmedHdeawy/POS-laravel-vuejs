<template>
  <div class="container my-5">
    <div class="row justify-content-center align-items-center">
      <div class="card w-100">
        <div class="card-header">اضافة فاتورة</div>
        <div class="card-body">
          <form>
            <div class="row">
              <div class="col">
                <v-select
                  dir="rtl"
                  v-model="formData.product_id"
                  :options="products"
                  :reduce="product => product.id"
                  placeholder="اكتب اسم المنتج"
                ></v-select>
              </div>
              <div class="col">
                <input
                  type="number"
                  min="1"
                  v-model="formData.product_quantity"
                  class="form-control"
                  placeholder="العدد"
                />
              </div>
              <div class="col">
                <input
                  type="text"
                  v-model="formData.product_price"
                  class="form-control"
                  placeholder="السعر"
                  readonly
                />
              </div>
              <div class="col">
                <button class="btn btn-primary" @click.prevent="addItemToOrder">اضافة الى الفاتورة</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div v-if="orderData.length > 0" class="row my-5 justify-content-center align-items-center">
      <!-- Show Spinner when save Order -->
      <div v-if="loader.load">
        <bounce-loader class="custom-class" :color="loader.color" :size="loader.size"></bounce-loader>
      </div>

      <div v-else class="card w-100" id="printMe">
        <div class="card-header">
          <div class="row mb-3">
            <div class="col-4">
              <img
                src="/img/logo-large.jpeg"
                class="img-fluid img-thumbnail"
                style="height: 100px !important"
              />
            </div>
            <div
              class="col-4 font-weight-bold justify-content-center align-items-center d-flex"
            >{{ dateNow }}</div>
            <div class="col-4 align-items-center justify-content-center d-flex">
              <button
                class="btn btn-success saveOrderButton btn-lg"
                style="font-size:2rem !important"
                @click.prevent="saveOrder"
              >حفظ الفاتورة</button>
            </div>
          </div>
        </div>
        <div class="card-header">
          <h4 class="row">
            <div class="col-4">تفاصيل الفاتورة</div>
            <div class="col-4">
              <!-- <button
                class="btn btn-success saveOrderButton"
                @click.prevent="saveOrder"
              >حفظ الفاتورة</button>-->
            </div>
            <div class="col-4">
              <span class="float-left text-danger font-weight-bold">
                الاجمالي:
                {{ orderPrice }}
              </span>
            </div>
          </h4>
        </div>
        <div class="card-body">
          <order-items :items="orderData"></order-items>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import OrderItems from "./OrderItems";
import { BounceLoader } from "@saeris/vue-spinners";
import moment from "moment";
export default {
  components: {
    vSelect,
    OrderItems,
    BounceLoader
  },
  data() {
    return {
      formData: {
        product_id: null,
        product_name: "",
        product_quantity: 1,
        product_price: 0
      },
      orderData: [],
      orderPrice: 0,
      products: [],
      allProducts: [],
      dateNow: "",
      loader: {
        load: false,
        size: 200,
        color: "#3490dc"
      }
    };
  },
  watch: {
    "formData.product_quantity": function(val, oldVal) {
      if (this.formData.product_id) {
        if (this.formData.product_id) {
          let productPrice = _.find(this.allProducts, {
            id: this.formData.product_id
          }).price;

          this.formData.product_price = productPrice * val;
        }
      }
    },

    "formData.product_id": function(val, oldVal) {
      if (this.formData.product_id) {
        if (this.formData.product_id) {
          let product = _.find(this.allProducts, {
            id: val
          });

          let productQuantity = this.formData.product_quantity;

          this.formData.product_price = product.price * productQuantity;
          this.formData.product_name = product.name;
        }
      }
    }
  },
  mounted() {
    this.loadProducts();

    moment.locale("ar");
    this.dateNow = moment().format("dddd ( Do MMMM YYYY )");
  },
  methods: {
    loadProducts() {
      axios.get("loadProducts").then(data => {
        let loadedProducts = (this.allProducts = data.data);

        // Loop through products from server
        loadedProducts.forEach(product => {
          this.products.push({
            label: product.name,
            id: product.id
          });
        });
      });
    },
    addItemToOrder() {
      if (this.formData.product_id && this.formData.product_price > 0) {
        this.orderData.push({
          product_id: this.formData.product_id,
          product_name: this.formData.product_name,
          product_quantity: this.formData.product_quantity,
          product_price: this.formData.product_price
        });

        // Get Order total
        this.orderPrice +=
          this.formData.product_quantity * this.formData.product_price;

        // Empty Object
        this.formData.product_id = null;
        this.formData.product_name = "";
        this.formData.product_quantity = 1;
        this.formData.product_price = 0;
      } else {
        Vue.$toast.open({
          message:
            "اسم المنتج أو الكميه خطأ. من فضلك اختار منتج أو اكتب كميه صحيحه",
          type: "error",
          position: "top",
          duration: 5000
        });
      }
    },
    saveOrder() {
      this.loader.load = true;

      axios
        .post("/saveOrder", {
          products: this.orderData
        })
        .then(data => {
          this.loader.load = false;
          //   Success Message
          Vue.$toast.open({
            message: "تم حفظ الفاتورة بنجاح",
            type: "success",
            position: "top",
            duration: 10000
          });

        // Print Invoice after one seconds
        setTimeout(() => {
            this.$htmlToPaper("printMe");
            this.orderData = [];
        }, 1000);

        })
        .catch(err => {});
    }
  }
};
</script>
