<template>
  <div class="my-4">
    <div class="row justify-content-center align-items-center">
      <div class="card w-100">
        <div class="card-header font-weight-bold">بحث عن صنف</div>
        <div class="card-body">
          <form>
            <div class="row">
              <div class="col">
                <input
                  type="text"
                  v-model="searchData.name"
                  class="form-control"
                  placeholder="اسم الصنف"
                />
              </div>
              <div class="col">
                <input
                  type="number"
                  min="1"
                  v-model="searchData.quantity"
                  class="form-control"
                  placeholder="الكميه"
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
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      searchData: {
        name: "",
        quantity: null,
        price: null
      }
    };
  },
  methods: {
    search() {
      axios.post("/admin/searchProducts", this.searchData).then(data => {
        console.log(data);

        //   Emit Event to Pranet
        this.$emit("search-products", data.data);
      });
    }
  }
};
</script>
