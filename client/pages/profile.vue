<template>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="row p-4">
            <div class="col-md-6">
              <div class="card mx-auto p-2 rounded border border-secondary">
                <div class="mx-auto">
                  <img :src="user.photo_url" alt="photo" style="width: 200px" class="p-2 rounded-circle img-responsive">
                </div>
                <h3 class="font-weight-bold mx-auto mt-2">{{ user.name }}</h3>
                <h5 class="font-italic mx-auto">Software Engineer</h5>
                <h6 class="font-italic mx-auto">Tuban, Indonesia</h6>
                <span class="text-center m-2">
                  Hello. I'm <b>{{ user.name }}</b>, from Indonesia 🇮🇩,
                  I'm a person with strong passion to learn new things🧗‍♂️.
                  Currently, I'm interested and learning about Software Development.
                  Experienced for approximately more 1 year and always try to continue to improve my skills.
                  And I love being a Software Engineer 👨‍💻.
                </span>
                <p class="text-center m-3">© 2021 All rights reserved • With ❤️ from Indonesia</p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="mx-auto">
                <div class="card mt-2 mb-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Full Name</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        {{ user.name }}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        {{ user.email }}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Phone</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        -
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Mobile</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        (+62) 896-8735-3934
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Address</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        Tuban, East Java, Indonesia
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="mx-auto">
                <div class="card mb-3">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round" class="feather feather-github mr-2 icon-inline">
                          <path
                            d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                          </path>
                        </svg>Github</h6>
                      <a href="https://www.github.com/dibaliqaja" class="text-secondary">dibaliqaja</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info">
                          <path
                            d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                          </path>
                        </svg>Twitter</h6>
                      <a href="https://www.twitter.com/dibaliqaja" class="text-secondary">@dibaliqaja</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger">
                          <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                          <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                          <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                        </svg>Instagram</h6>
                      <a href="https://www.instagram.com/dibaliqaja" class="text-secondary">dibaliqaja</a>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                      <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                          viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                          stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary">
                          <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg>Facebook</h6>
                      <a href="https://www.facebook.com/dibaliqaja" class="text-secondary">dibaliqaja</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {

  computed: mapGetters({
    user: 'auth/user'
  }),

}
</script>
