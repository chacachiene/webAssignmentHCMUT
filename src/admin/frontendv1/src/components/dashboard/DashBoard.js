import React from "react";
import { useState, useContext } from "react";
//node_modules/bootstrap/dist/css/bootstrap.min.css
import "../../../node_modules/bootstrap/dist/css/bootstrap.min.css";
import { Row, Col } from "react-bootstrap";
import styles from "./Home.module.css";
import ProgressBar from "../ui/progress/ProgressBar";
import DoughnutChart from "../ui/charts/DoughNutChart.js";
import VerticalChart from "../ui/charts/VerticalChart";
import {getNumberProduct, getProductNotSell, getUserActive, getProductType} from '../../services/dashboardService';
const DashBoard = () => {
  const [product, setProduct] = React.useState(0);
  const [notSell, setNotSell] = React.useState(0);
  const [active, setActive] = React.useState({
    active: '',
    off: ''
  });
  const [off, setOff] = React.useState(1);
  const [type, setType] = React.useState({
    Macbook: '',
    Ipad: '',
    Iphone: '',
    Applewatch: '',
  });
  React.useEffect(() => {
    async function fetchData() {
      try {
        const response = await getNumberProduct();
        setProduct(response);
        console.log(response);

        const responseNotSell = await getProductNotSell();
        setNotSell(responseNotSell);
        console.log(responseNotSell);

        const responActive = await getUserActive();
        setActive(responActive);
        console.log(responActive);

        // const responOff = await getUserOff();
        // setOff(responOff);
        // console.log(responOff);

        const responType = await getProductType();
        setType(responType);
        console.log(responType);
          
      } catch (error) {
        console.error(error);
      }
    }
    fetchData();
  }, [product]);

  console.log(product);
  console.log(type);



  const monthWatse = {
    value: {
      revenue: [20, 23, 45, 65, 100, 60, 80],
      income: [10, 13, 30, 50, 70, 50, 60],
    },
    month: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
  };

  const tasksJanitor = 70;
  const tasksCollector = 70;
  const monthWaste = 36353000;
  
  const tasksTotal = 20;
  return (
    <React.Fragment>
      <Row>
        <div className={styles.container}>
          <div className={styles.statistic}>
            <Col xl={4} md={4} sm={12}>
              <div className={styles.targetContainer}>
                <h6 className={styles.containerTitle}>PRODUCTS SOLD</h6>
                <div className={styles.targetNumber}>{product}</div>
                <div className={styles.lineDivider}></div>
                <div className={styles.progressBar}>
                  <ProgressBar value={(product*100)/notSell} />
                </div>
              </div>
            </Col>

            <Col xl={4} md={4} sm={12}>
              <div className={styles.cartContainer}>
                <h6 className={styles.containerTitle}>CARD</h6>
                <div className={styles.cartChart}>
                  <span className={styles.textPie}>
                    
                    Macbook: {type.Macbook} <br />
                    Iphone: {type.Iphone} <br />
                    Ipad: {type.Ipad} <br />
                    Applewatch: {type.Applewatch} <br />
                  </span>
                  <DoughnutChart dataInput={[type.Macbook, type.Iphone, type.Ipad, type.Applewatch]} size={120} />
                </div>
              </div>
            </Col>

            <Col xl={4} md={4} sm={12}>
              <div className={styles.onlineContainer}>
                <h6 className={styles.containerTitle}>USER</h6>
                <div className={styles.onlineChart}>
                  <span className={styles.textPie}>
                    Online  <br /> {active.active*100/(active.active+active.off)}%
                  </span>
                  <DoughnutChart dataInput={[active.active, active.off]} size={120} />
                </div>
              </div>
            </Col>
          </div>
        </div>
      </Row>
      <Row>
        <div className={styles.monthlyChart}>
          <h6 className={styles.monthlyChartTitle}>Monthly (VND)</h6>
          <div className={styles.monthlyChartContent}>
            {Intl.NumberFormat().format(monthWaste)}
            {/*<div className={styles.}></div> */}
          </div>
          <VerticalChart dataInput={monthWatse} size={600} />
        </div>
      </Row>
    </React.Fragment>
  );
};

export default DashBoard;