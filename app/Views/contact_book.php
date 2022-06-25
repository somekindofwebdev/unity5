<link rel=stylesheet href="css/shared.css"/>

<script src="https://unpkg.com/vue@3"></script>

<script type="module">
    const { createApp } = Vue
    import Contact from "./js/contact.js"
    import Editor from "./js/editor.js"
    createApp({
        data() {
            return {
                contactId: 1,
                contactData: [],
                contact: {},
                hideInactive: false
            }
        },
        computed: {
            activeContactData() {
                return this.hideInactive ? this.contactData.filter(c => c.active == true) : this.contactData;
            }
        },
        watch: {
            contactId(newId) {
                this.contact = this.contactData[this.contactId];
            }
        },
        methods: {
            async fetchData() {
                this.contactData = []
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
            },
            updateContact() {
                fetch(
                    'Contacts/' + this.contactId,
                    {
                        method: "PATCH",
                        body: { contact: this.contact }
                    }
                )
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
    <button @click="hideInactive = !hideInactive">{{ hideInactive ? 'Show all' : 'Hide inactive contacts' }}</button>
    <div id=contact-list>
        <ul>
            <contact
                     v-for="c in activeContactData"
                     :contact="c"
                     @click="this.contactId = c.ID - 1"
                     ></contact>
        </ul>
    </div>
    <ul id=contact-editor>
        <li>
            <label for="editor-firstname">First name:</label>
            <input id="editor-firstname" type=text v-model="contact.first_name"  />
        </li>
        <li>
            <label for="editor-middlename">Middle name:</label>
            <input id="editor-middlename" type=text v-model="contact.middle_name"  />
        </li>
        <li>
            <label for="editor-lastname">Last name:</label>
            <input id="editor-lastname" type=text v-model="contact.last_name"  />
        </li>
        <li>
            <label for="editor-dateofbirth">Date of birth:</label>
            <input id="editor-dateofbirth" type=text v-model="contact.date_of_birth"  />
        </li>
        <li>
            <label for="editor-address">Address:</label>
            <input id="editor-address" type=text v-model="contact.address"  />
        </li>
        <li>
            <label for="editor-postcode">Postcode:</label>
            <input id="editor-postcode" type=text v-model="contact.postcode"  />
        </li>
        <li>
            <label for="editor-telephone_number">Telephone number:</label>
            <input id="editor-telephonenumber" type=text v-model="contact.telephone_number"  />
        </li>
        <li>
            <label for="editor-email">Email:</label>
            <input id="editor-email" type=text v-model="contact.email"  />
        </li>
        <button @click="updateContact">Update contact</button>
    </ul>
</div>