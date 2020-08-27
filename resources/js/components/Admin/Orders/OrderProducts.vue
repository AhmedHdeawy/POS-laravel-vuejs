<template>
  <div>
    <div
      class="modal fade"
      id="OrderProducts"
      tabindex="-1"
      role="dialog"
      aria-labelledby="OrderProductsLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <div class="card w-100">
              <div class="card-header">
                <div class="row">
                  <h4 class="col-8">اصناف الفاتورة</h4>
                  <h4 class="col-4">
                      الاجمالي:
                      <span class="text-danger">{{ price }}</span>
                    </h4>
                </div>
              </div>
              <div class="card-body">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr class="text-center">
                      <th scope="col">اسم المنتج</th>
                      <th scope="col">السعر</th>
                      <th scope="col">الكميه</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="product in products" :key="product.id">
                      <td>{{ product.product.name }}</td>
                      <td>{{ product.price }}</td>
                      <td>{{ product.quantity }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    products: {
      type: Array,
      required: true
    },
    price: {
      default: 1
    }
  }
};
</script>
