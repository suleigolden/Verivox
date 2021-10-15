import React, { Component } from "react";
import { Button } from "reactstrap";
import axios from 'axios';
import { API_BASE_URL } from './config';

export default class Home extends Component {
  constructor(props) {
    super(props);
    this.state = {
        sendData:{
            tariffName: '',
            yearlyConsumption: '',
         },
      data: [],
      feedbackMessage: '',
      isLoadingToSend: false,
    }
  };

  onSubmitToEmpHandler = (e) => {
    console.log(this.state.sendData);
    this.setState({ isLoadingToSend: true });
    axios
      .post(API_BASE_URL+`api/calculate/tariff`,this.state.sendData)
      .then((response) => {
        this.setState({ isLoadingToSend: false });
        
        console.log('..: '+response.data.result);
        if (response.data.status === 200) {
            
            console.log('OK.....');
        }

        if (response.data.status !== 200) {
          this.setState({ feedbackMessage: response.data.result });
          setTimeout(() => {
            this.setState({ feedbackMessage: "" });
          }, 2000);
        }
      });
  };
fetchData = async () => {
    const { data } = await axios.get(API_BASE_URL + `api/get/tariff`);
    this.setState({ data: data.data });
};

componentDidMount() {
    this.fetchData();
};

handleChange = (e) => {
    const { sendData } = this.state;
    sendData[e.target.name] = e.target.value;
    this.setState({ sendData });
};

  render() {
    const isLoadingToSend = this.state.isLoadingToSend;

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
                        <select className="form-control" name="tariffName"
                                    value={this.state.sendData.tariffName}
                                    onChange={e => this.handleChange(e)}>
                            <option value="">Select Name</option>
                            <option value="BasicElectricityTariff">Basic Electricity Tariff</option>
                            <option value="PackagedTariff">Packaged Tariff</option>
                        </select>
                        </div>
                    </div>
                    <div className="col-md-4">
                        <div className="form-group">
                        <label className="input-text">Consumtion Cost/Wh/(€/year)</label>
                        <input type="number" className="form-control" name="yearlyConsumption" placeholder="Consumtion Cost" 
                                value={this.state.sendData.yearlyConsumption}
                                onChange={e => this.handleChange(e)}
                        required></input>
                        </div>
                     </div>
                     <div className="col-md-3">
                     
                     <Button style={{marginTop:'32px'}}
                            className="btn btn-success mb-2"
                            onClick={this.onSubmitToEmpHandler}
                         >Submit
                            {isLoadingToSend ? (
                                <span className="spinner-border spinner-border-sm ml-5"
                                       role="status"
                                        aria-hidden="true"></span>
                                ) : (
                                    <span></span>
                            )}
                    </Button>
                     </div>
                       
                  </div>
                  <h4 className="text-success">{this.state.feedbackMessage}</h4>
              </form>
              <br/><br/><br/>
             <h1>Tariff History</h1>
              <table className="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Cost (€/year)</th>
                </tr>
                </thead>
                <tbody>
                {
                    this.state.data.map((rec,i) => 
                        <tr key={i}>
                            <td>{rec.name}</td>
                            <td><b>€{rec.tariff_cost.toLocaleString(navigator.language, { minimumFractionDigits: 0 })}</b></td>
                      </tr>
                    ) 
                }
                  
                </tbody>
            </table>
           </div>
        </div>
    );
  }
}