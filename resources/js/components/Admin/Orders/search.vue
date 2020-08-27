<template>
  <div class="my-4">
    <div class="row justify-content-center align-items-center">
      <div class="card w-100">
        <div class="card-header font-weight-bold">بحث عن فاتورة</div>
        <div class="card-body">
          <form>
            <div class="row">
              <div class="col">
                <datepicker
                  placeholder="التاريخ"
                  input-class="form-control"
                  clear-button
                  :format="customFormatter"
                  v-model="date"
                ></datepicker>
              </div>

              <div class="col">
                <input
                  type="text"
                  v-model="searchData.name"
                  class="form-control"
                  placeholder="اسم العميل"
                />
              </div>
              <div class="col">
                <input
                  type="text"
                  v-model="searchData.price"
                  class="form-control"
                  placeholder="السعر"
                />
              </div>
              <div class="col">
                <button class="btn btn-primary" @click.prevent="search">بحث</button>
                <button class="btn btn-danger" @click.prevent="resetForm">مسح القيم</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";
import moment from "moment";
export default {
  components: {
    Datepicker
  },
  data() {
    return {
      date: null,
      searchData: {
        date: null,
        name: null,
        price: null
      }
    };
  },
  watch: {
    date: function(val) {
      if (val) {
        this.searchData.date = moment(val).format("YYYY-MM-DD");
      }
    }
  },
  methods: {
    search() {
      axios.post("/admin/searchOrders", this.searchData).then(data => {
        console.log(data);

        //   Emit Event to Pranet
        this.$emit("search-orders", data.data);
      });
    },
    customFormatter(date) {
      return moment(date).format("DD-MM-YYYY");
    },
    resetForm() {
        this.searchData.date = this.searchData.name = this.searchData.price = this.date = null;
    }
  }
};
</script>
