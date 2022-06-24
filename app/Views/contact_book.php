<script src="https://unpkg.com/vue@3"></script>

<script type="module">
  const { createApp } = Vue

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
  mounted() {
    this.fetchData()
  }
}).mount('#app')
</script>

<div id="app">
    <p>contact id: {{ contactId }}</p>
    <button @click="contactId++">Fetch next contact</button>
    <p v-if="!contactData">Loading...</p>
    <ul>
        <li v-for="c in contactData">{{ c["first_name"] }}</li>
    </ul>
</div>