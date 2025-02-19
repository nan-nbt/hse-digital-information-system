CREATE TABLE HSE_DATA_ACCIDENT
(
  FACT_NO       VARCHAR2(4 BYTE)                NOT NULL,
  SUBMIT_ID     VARCHAR2(50 BYTE)               NOT NULL,
  SUBMIT_DATE   VARCHAR2(14 BYTE),
  SUBMIT_USER   VARCHAR2(10 BYTE),
  AREA_NO       VARCHAR2(2 BYTE),
  AREA_SCORE    NUMBER(7,2),
  TOT_LTI       NUMBER(5),
  TOT_NLTI      NUMBER(5),
  TOT_LOST_DAY  NUMBER(5),
  TOT_ACCIDENT  NUMBER(5)
)
TABLESPACE SIS_DATA
PCTUSED    0
PCTFREE    10
INITRANS   1
MAXTRANS   255
STORAGE    (
            INITIAL          64K
            NEXT             1M
            MINEXTENTS       1
            MAXEXTENTS       2147483645
            PCTINCREASE      0
            BUFFER_POOL      DEFAULT
           )
LOGGING 
NOCOMPRESS 
NOCACHE
NOPARALLEL
MONITORING;

ALTER TABLE HSE_DATA_ACCIDENT ADD (
  CONSTRAINT PK_HSE_DATA_ACCIDENT
 PRIMARY KEY
 (FACT_NO, SUBMIT_ID) DISABLE);


