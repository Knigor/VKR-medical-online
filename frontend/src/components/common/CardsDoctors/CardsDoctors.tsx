import styles from "./CardsDoctors.module.css";
import { ButtonCards } from "../ButtonCard";

type CardsDoctors = {};

export const CardsDoctors: React.FC<CardsDoctors> = ({}) => {
  return (
    <div className={`${styles.cardsDoctors}  flex  border-gray-300`}>
      <div className="flex flex-col mt-[32px] ml-[20px]">
        <h2 className={`${styles.textHeader}`}>Дежурный терапевт</h2>
        <p className={`${styles.text} mt-[6px] mb-[21px] text-gray-500`}>
          По записи
        </p>
        <ButtonCards text="Выбрать" />
      </div>
      <div className="mt-[42px] mr-[16px]">
        <img className="" src="../../public/Ellipse_3.svg" alt="За стеклом" />
      </div>
    </div>
  );
};
