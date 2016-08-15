var CommentBox = React.createClass({

deleteMessage: function(message){
var newMessages = _.without(this.state.messages, message);
this.setState({
messages: newMessages
});
},

handleAdd: function(e){
var newMessage = this.refs.newMessage.getDOMNode().value;
var newMessages = this.state.messages.concat([newMessage]);
this.setState({
messages: newMessages
});
},
getInitialState: function(){
return {
isVisible: true,
messages: [
'this is me',
'this is u',
'this is bokchod',
]
}
},
render: function() {
var inLineStyles = {
display: this.state.isVisible ? 'block': 'none'
};
var messages = this.state.messages.map(function(message){
return <SubMessage message={message} onDelete= {this.deleteMessage} />;
}.bind(this));
return (
<div className="container jumbotron" style={inLineStyles}>
 <h1>Yoo!</h1>
 <input ref= "newMessage" type="text" />
 <button className="btn btn-primary" onClick={this.handleAdd}>Add</button>
 {messages}
</div>
);
}
});



var SubMessage = React.createClass({

handleDelete: function(e){
this.props.onDelete(this.props.message);
},

propTypes: {
message: React.PropTypes.string.isRequired
},

getDefaultsProps: function(){
return {
message: 'Its good to see you'
};
},

render: function() {
return (
<div>
 {this.props.message}
 <button onClick= {this.handleDelete} className="btn btn-danger" >X</button>
</div>
);
}
});



ReactDOM.render(
<CommentBox />,
document.getElementById('content')
);


/**
 *
 * 2nd tutorial
 *
 */
  var App = React.createClass({
    mixins : [React.addons.LinkedStateMixin],

    getInitialState : function(){
      return{
        payment:0,
        payment2:0
      }
    },
    render: function() {
    var total= parseInt(this.state.payment, 10) + parseInt(this.state.payment2, 10);
      return (
        <div className="App">
         <Payment valueLink={this.linkState('payment')} />
         +
         <Payment valueLink={this.linkState('payment2')} />
         {total}
        </div>
      );
    }
  });



  var Payment = React.createClass({
    render: function() {
      return (
       <input {...this.props} type="text" />
      );
    }
  });

ReactDOM.render(
  <App />,
  document.getElementById('content')
);