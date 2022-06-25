<link rel=stylesheet href="css/shared.css"/>

<script src="https://unpkg.com/vue@3"></script>

<script type="module">
    const { createApp } = Vue
    import Contact from "./js/contact.js"
    createApp({
      data() {
        return {
          contactId: 1,
          contactData: null
        }
      },
      methods: {
        async fetchData() {
          this.contactData = null
          fetch(
            'Contacts',
            {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json"
                }
            }
          )
          .then(response => response.json())
          .then(data => this.contactData = data)
        }
      },
    components: {
        Contact
    },
      mounted() {
        this.fetchData()
      }
  }).mount('#app')
</script>

<div id="app">
    <ul>
        <contact
                 v-for="c in contactData"
                 :first_name="c.first_name"
                 :middle_name="c.middle_name"
                 :last_name="c.last_name"
                 :address="c.address"
                 :postcode="c.postcode"
                 ></contact>
    </ul>
</div>