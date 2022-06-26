<title>Contact Book</title>
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
                contact: {
                    first_name: "",
                    middle_name: "",
                    last_name: "",
                    date_of_birth: "",
                    address: "",
                    postcode: "",
                    telephone_number: "",
                    email: "",
                    active: 1
                },
                hideInactive: false,
                message: null
            }
        },
        computed: {
            activeContactData() {
                return this.hideInactive ? this.contactData.filter(c => c.active) : this.contactData;
            }
        },
        watch: {
            contactId(newId) {
                this.contact = this.contactData.find(c => c.contact_id == newId);
            }
        },
        // TODO some of the below can probably be refactored into a function to keep it DRY
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
                .then(response => {
                    var j = response.json();
                    if (!response.ok) {
                        response.json().then(jErr => this.message = jErr.messages.error);
                        throw new Error("Error occurred");
                    }
                    return j;
                })
                .then(data => this.contactData = data)
                .catch(err => console.log(err))
            },
            async updateContact() {
                fetch(
                    'Contacts/' + this.contactId,
                    {
                        method: "PATCH",
                        body: JSON.stringify(this.contact)
                    }
                )
                .then(response => {
                    if (!response.ok) {
                        response.json().then(jErr => this.message = jErr.messages.error);
                        throw new Error("Validation error");
                    }
                    else {
                        return response.json();
                    }
                })
                .then(j => this.message = "Contact ID " + j.toString() + " updated")
                .catch(err => console.log(err))
                
            },
            async addContact() {        
                // Add to contactData
                this.contactData.push(this.contact);
                
                // Create new contact
                fetch(
                    'Contacts',
                    {
                        method: "POST",
                        body: JSON.stringify(this.contact)
                    }
                )
                .then(response => {
                    if (!response.ok) {
                        response.json().then(jErr => this.message = jErr.messages.error);
                        throw new Error("Validation error");
                    }
                    else {
                        return response.json();
                    }
                })
                .then(j => this.message = "Contact added with ID " + j.toString())
                .catch(err => console.log(err))
            },
            errorCheck(response) {
                var j = response.json();
                if (!response.ok) {
                    this.message = j;
                    throw new Error("Error");
                }
                return j;
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
        <h3>Contacts</h3>
        <button @click="hideInactive = !hideInactive">{{ hideInactive ? 'Show all' : 'Hide inactive contacts' }}</button>
        <ul>
            <contact
                     v-for="c in activeContactData"
                     :contact="c"
                     @click="this.contactId = c.contact_id"
                     ></contact>
        </ul>
    </div>
    <form id=contact-editor @submit.prevent>
        <h3>Edit contact</h3>
        <p>To add a contact, overwrite these details and click "Add contact"</p>
        <!-- No frontend validation - challenge is to validate AJAX request -->
        <div>{{ message }}</div>
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
        <li>
            <input type=button id="editor-active" @click="contact.active = !contact.active" :value=" contact.active == 1 ? 'Disable contact' : 'Enable contact'"/>
        </li>
        <button @click="updateContact">Update contact</button>
        <button @click="addContact">Add contact</button>
    </form>
</div>