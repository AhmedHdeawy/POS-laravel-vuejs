<template>
  <div class="container-fluid mb-5">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
      <a class="navbar-brand" href="#">
        <img src="/img/logo-large.jpeg" width="30" height="30" alt />
      </a>

      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item mx-3 font-weight-bold">
            <a class="nav-link" href="/admin">
              الفواتير
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item mx-3 font-weight-bold">
            <a class="nav-link" href="/admin/products">الاصناف</a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>

<script>
export default {};
</script>
