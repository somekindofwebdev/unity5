<link rel=stylesheet href="css/shared.css"/>

<script src="https://unpkg.com/vue@3"></script>

<script type="module">
    const { createApp } = Vue
    import Contact from "./js/contact.js"
    createApp({
        data() {
            return {
                contactId: 1,
                contactData: null,
                contact: {}
            }
        },
        watch: {
            contactId(newId) {
                this.contact = this.contactData[this.contactId];
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
    <div id=contact-list>
        <ul>
            <contact
                     v-for="c in contactData"
                     :first_name="c.first_name"
                     :middle_name="c.middle_name"
                     :last_name="c.last_name"
                     :address="c.address"
                     :postcode="c.postcode"
                     @click="this.contactId = c.ID - 1"
                     ></contact>
        </ul>
    </div>
    <div id=contact-editor>
        <label for="editor-firstname">First name:</label>
        <input id="editor-firstname" type=text v-model="contact.first_name"  />
        <label for="editor-middlename">Middle name:</label>
        <input id="editor-middlename" type=text v-model="contact.middle_name"  />
        <label for="editor-lastname">Last name:</label>
        <input id="editor-lastname" type=text v-model="contact.last_name"  />
        <label for="editor-dateofbirth">Date of birth:</label>
        <input id="editor-dateofbirth" type=text v-model="contact.date_of_birth"  />
        <label for="editor-address">Address:</label>
        <input id="editor-address" type=text v-model="contact.address"  />
        <label for="editor-postcode">Postcode:</label>
        <input id="editor-postcode" type=text v-model="contact.postcode"  />
        <label for="editor-telephone_number">Telephone number:</label>
        <input id="editor-telephonenumber" type=text v-model="contact.telephone_number"  />
        <label for="editor-email">Email:</label>
        <input id="editor-email" type=text v-model="contact.email"  />
    </div>
</div>