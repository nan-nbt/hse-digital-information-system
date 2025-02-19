CREATE TABLE HSE_DATA_ASPECT
(
  FACT_NO    VARCHAR2(4 BYTE)                   NOT NULL,
  ASPECT_NO  VARCHAR2(2 BYTE)                   NOT NULL,
  ASPECT_NM  VARCHAR2(50 BYTE),
  SORT_SEQ   VARCHAR2(3 BYTE),
  STOP_MK    VARCHAR2(1 BYTE),
  DIM_NO     VARCHAR2(2 BYTE)
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

ALTER TABLE HSE_DATA_ASPECT ADD (
  CONSTRAINT PK_HSE_DATA_ASPECT
 PRIMARY KEY
 (FACT_NO, ASPECT_NO) DISABLE);


