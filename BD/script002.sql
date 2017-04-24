USE [subastaBNB]
GO
/****** Object:  Table [dbo].[mdl_subasta_aprobar]    Script Date: 24/04/2017 09:38:09 a.m. ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[mdl_solicitud_aprobar](
	[soa_uid] [int] IDENTITY(1,1) NOT NULL,
	[soa_sol_uid] [int] NOT NULL,
	[soa_usr_uid] [int] NOT NULL,
	[soa_date] [datetime] NOT NULL,
	[soa_status] [varchar](8) NOT NULL,
 CONSTRAINT [PK_mdl_solicitud_aprobar] PRIMARY KEY CLUSTERED 
(
	[soa_uid] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO
SET ANSI_PADDING OFF
GO

ALTER TABLE mdl_subasta_informe ADD sua_usr_apr int null 
go