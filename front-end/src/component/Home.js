import React, { Component } from "react";
import {
  Redirect,
} from "react-router-dom";

export default class Home extends Component {
  constructor(props) {
    super(props);
    this.state = {
      tariffName: '',
      yearlyConsumption: ''
    }
  };
  handletariffNameChange(e) {
    this.setState({
      tariffName: e.target.value
    });
  };
  handleyearlyConsumptionChange(e) {
    this.setState({
      yearlyConsumption: e.target.value
    });
  };

  render() {
  
    return (
        <div className="row" style={{minwidth:'100%', padding:'20px'}}>
        
           <div className="col-md-3"></div>
           <div className="col-md-6 box-shadow" align="center">
             <h1>Verivox Task</h1>
              <form action="#" id="actionForm">
                <div className="row">
                    <div className="col-md-4">
                        <div className="form-group">
                        <label>Tariff Name</label>
                        <select className="form-control" 
                                    value={this.state.tariffName}
                                    onChange={e => this.handletariffNameChange(e)}>
                            <option value="">Select Name</option>
                            <option value="BasicElectricityTariff">Basic Electricity Tariff</option>
                            <option value="PackagedTariff">Packaged Tariff</option>
                        </select>
                        </div>
                    </div>
                    <div className="col-md-4">
                        <div className="form-group">
                        <label className="input-text">Consumtion Cost/Wh/year</label>
                        <input type="number" className="form-control" placeholder="Consumtion Cost" 
                                value={this.state.yearlyConsumption}
                                onChange={e => this.handleyearlyConsumptionChange(e)}
                        required></input>
                        </div>
                     </div>
                     <div className="col-md-3">
                     <button style={{marginTop:'22px'}} className="btn btn-success block"
                                onClick={() => this.setState({ navigate: true })}>Submit</button>
                     </div>
                       
                  </div>
              </form>
             
           </div>
          
        </div>
    );
  }
}