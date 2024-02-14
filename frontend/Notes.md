- When using data to declare a state and methods you have to use this.state
- In vue there is a function to map an array  like

  - v-for :

    ```javascript
    <div v-for="item in items" :key="item.id">
      {{ item }}
    </div>



    ```
- Just like there exists a v-for, you also have v-if

  ```javascript
  <div id="app">
    <p v-if="showMessage">This message is displayed because showMessage is true.</p>
    <p v-else>This message is displayed when showMessage is false.</p>
  </div>
  ```
- It is recommended not to use v-for and v-if in the same component since v-if has proprity over v-for

### Props

The Custom Input component accepts the following props:

* **label** (String, required): The label for the input field.
* **:type="type"**: Binds the `type` prop to the `type` attribute of the `<input>` element. This allows you to dynamically set the input type (e.g., text, password) based on the prop passed to the component.
* **:value="value"**: Binds the `value` prop to the `value` attribute of the `<input>` element. This sets the initial value of the input field based on the prop passed to the component.
* **@input="$emit('input', $event.target.value)"**: Listens for the "input" event on the `<input>` element. When the user types into the input field, this event handler is triggered. The `$emit` function is then used to emit a custom "input" event with the updated value of the input field (`$event.target.value`). This custom "input" event is then used for two-way data binding using `v-model` when the component is used in a parent component.

```js

<label>{{ label }}</label>
<input
     :type="type"
     :value="value"
     @input="$emit('input', $event.target.value)"
/>
```

Then you define the props of the components:

```js
<script>
export default {
    props: {
        label: {
            type: String,
            required: true
        },
        type: {
            type: String,
            default: 'text'
        },
        value: {
            type: [String, Number],
            default: ''
        }
    }
}
</script>
```

Here is an example on how to use this

# Routing

## Meta property when routing

You can pass properties you want specifically for an specific field that are associated with the route, they are used to control some aspects of the routes
