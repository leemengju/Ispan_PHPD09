import React, { Component } from 'react';
 
class MemberEdit extends Component {
    state = {  }
    render() {
        return (<div>Edit Member: {this.props.match.params.who}</div>);
    }
}
 
export default MemberEdit;


