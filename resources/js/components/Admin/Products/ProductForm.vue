<template>
  <div>
    <div
      class="modal fade"
      id="ProductForm"
      tabindex="-1"
      role="dialog"
      aria-labelledby="ProductFormLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ProductFormLabel">اضافة صنف جديد</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form v-if="!loader.load">
              <!-- Hidden Input to append ID when update Product -->
              <input v-model="productData.id" type="hidden" name="id" />

              <div class="form-group">
                <label for="name" class="col-form-label">اسم الصنف:</label>
                <input
                  v-model="productData.name"
                  type="text"
                  name="name"
                  class="form-control"
                  id="name"
                />
              </div>

              <div class="form-group">
                <label for="price" class="col-form-label">السعر:</label>
                <input
                  v-model="productData.price"
                  step="any"
                  type="number"
                  name="price"
                  class="form-control"
                  id="price"
                />
              </div>

              <div class="form-group">
                <label for="quantity" class="col-form-label">الكميه:</label>
                <input
                  v-model="productData.quantity"
                  step="any"
                  type="number"
                  name="quantity"
                  class="form-control"
                  id="quantity"
                />
              </div>
            </form>

            <div v-else class="col-12 justify-content-center d-flex my-5">
              <fade-loader
                class="custom-class"
                :heigh="loader.height"
                :width="loader.width"
                :color="loader.color"
                :size="loader.size"
              ></fade-loader>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
            <button type="button" class="btn btn-primary" @click="saveProduct">حفظ الصنف</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { FadeLoader } from "@saeris/vue-spinners";
export default {
  components: {
    FadeLoader
  },
  props: {
    productData: {
      type: Object,
      required: true
    }
  },
  data() {
    return {
      loader: {
        load: false,
        size: 100,
        color: "#3490dc",
        height: 30,
        width: 5
      }
    };
  },
  methods: {
    saveProduct() {
      // ValidateData
      if (!this.validateData()) return false;

      // Run Loader
      this.loader.load = true;

      axios
        .post("/admin/updateOrCreateProduct", this.productData)
        .then(data => {
          //   Emit Event to Pranet
          if (this.productData.id) {
            //   Update if Edit Product
            this.$emit("update-product", data.data);
          } else {
            //   Save New Product
            this.$emit("new-product", data.data);
          }

          this.loader.load = false;
          //   Success Message
          Vue.$toast.open({
            message: "تم اضافة الصنف بنجاح",
            type: "success",
            position: "top",
            duration: 3000
          });

          //   Hide Modal
          $("#ProductForm").modal("hide");
        })
        .catch(err => {
          console.log(err);
        });

      return true;
    },
    validateData() {
      if (
        this.productData.name === "" ||
        this.productData.price < 1 ||
        this.productData.quantity < 1
      ) {
        //   Success Message
        Vue.$toast.open({
          message: "من فضلك اكتب البيانات بشكل صحيح",
          type: "error",
          position: "top",
          duration: 3000
        });
        return false;
      }
      return true;
    }
  }
};
</script>
