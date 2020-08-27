<template>
  <div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">اسم المنتج</th>
          <th scope="col">العدد</th>
          <th scope="col">السعر</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(item, index) in items" :key="index">
          <th scope="row">{{ index+1 }}</th>
          <td>{{ item.product_name }}</td>
          <td>{{ item.product_quantity }}</td>
          <td>{{ item.product_price }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props: {
    items: {
      type: Array,
      required: true
    }
  }
};
</script>
