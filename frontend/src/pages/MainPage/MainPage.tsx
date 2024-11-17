import styles from "./MainPage.module.css";
import { CardsPopular } from "../../components/common/CardsPopular";

type MainPage = {};

export const MainPage: React.FC<MainPage> = () => {
  return (
    <div className="flex flex-col ml-[68px] mt-[68px]">
      <h1 className={`${styles.title}`}>Онлайн-консультации с врачами</h1>
      <h2 className={`${styles.subtitle} mt-[20px]`}>Популярные темы</h2>
      <div className="flex flex-wrap gap-[16px]">
        <CardsPopular textPopular="Боль в горле" />
        <CardsPopular textPopular="Боль в горле" />
        <CardsPopular textPopular="Боль в горле" />
        <CardsPopular textPopular="Боль в горле" />
        <CardsPopular textPopular="Боль в горле" />
        <CardsPopular textPopular="Боль в горле" />
        <CardsPopular textPopular="Боль в горле" />
      </div>
    </div>
  );
};
