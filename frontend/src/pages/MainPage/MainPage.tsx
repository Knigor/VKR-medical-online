import styles from "./MainPage.module.css";
import { CardsPopular } from "../../components/common/CardsPopular";
import { CardsDoctors } from "../../components/common/CardsDoctors";

type MainPage = {};

export const MainPage: React.FC<MainPage> = () => {
  return (
    <div className="flex flex-col ml-[68px] mt-[68px]">
      <h1 className={`${styles.title}`}>Онлайн-консультации с врачами</h1>
      <h2 className={`${styles.subtitle} mt-[20px]`}>Популярные темы</h2>
      <div className="flex flex-wrap gap-[16px]  mb-12">
        <CardsPopular textPopular="Боль в горле" />
        <CardsPopular textPopular="Боль в горле" />
        <CardsPopular textPopular="Боль в горле" />
        <CardsPopular textPopular="Боль в горле" />
        <CardsPopular textPopular="Боль в горле" />
        <CardsPopular textPopular="Боль в горле" />
        <CardsPopular textPopular="Боль в горле" />
        <CardsPopular textPopular="Боль в горле" />
        <CardsPopular textPopular="Боль в горле" />
        <CardsPopular textPopular="Боль в горле" />
      </div>
      <h2 className={`${styles.subtitle} mt-[20px]`}>Специалисты</h2>

      <div
        className={`${styles.doctors} grid grid-cols-3 max-xl:grid-cols-2 gap-[46px] mt-[43px] mb-[80px]`}
      >
        <CardsDoctors />
        <CardsDoctors />
        <CardsDoctors />
        <CardsDoctors />
        <CardsDoctors />
        <CardsDoctors />
        <CardsDoctors />
        <CardsDoctors />
        <CardsDoctors />
        <CardsDoctors />
        <CardsDoctors />
      </div>
    </div>
  );
};
